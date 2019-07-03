<?php

namespace App\Jobs;

use App\Contact;
use App\Services\AmoCrmService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportContacts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const CUSTOM_FIELDS = [
        'phone',
        'email',
        'position',
        'salary'
    ];

    /**
     * @var AmoCrmService $amoCrmService
     */
    private $amoCrmService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->amoCrmService = new AmoCrmService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->amoCrmService->authorize()->getContacts();
        $customFields = self::CUSTOM_FIELDS;
        $ids = Contact::select('original_id')->get()->pluck('original_id');

        $fillable = (new Contact())->getFillable();
        $fillableValues = array_fill_keys($fillable, null);

        $contacts = [];
        foreach ($data as $item){
            //if already added, go next
            if ($ids->contains($item->id)) continue;

            $contact = [
                'name' => $item->name,
                'original_id' => $item->id,
                'company' => $item->company->name ?? ''
            ];

            //Add custom fields, that we need
            foreach ($item->custom_fields as $field){
                $key = strtolower($field->name);

                if (in_array($key, $customFields) &&
                    in_array($key, $fillable)
                ){
                    $contact[$key] = $field->values[0]->value;
                }
            }

            $contacts[] = $contact+$fillableValues;
        }

        Contact::insert($contacts);
    }
}
