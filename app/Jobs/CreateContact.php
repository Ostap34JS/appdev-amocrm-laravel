<?php

namespace App\Jobs;

use Guzzle;
use App\Services\AmoCrmService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Format: field => id
     */
    const CUSTOM_FIELDS = [
        'Salary'   => 87677,
        'Position' => 87317,
    ];

    /**
     * @var array $data
     */
    private $data;

    /**
     * @var AmoCrmService $amoCrmService
     */
    private $amoCrmService;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->amoCrmService = new AmoCrmService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        $user = $this->amoCrmService->authorize()->user;

        $customFields = self::CUSTOM_FIELDS;
        foreach ($customFields as $key => $value){
            $key = strtolower($key);

            $fields[] = [
                'id' => $value,
                'values' => [
                    ['value' => $data[$key]]
                ]
            ];
        }

        Guzzle::post('/api/v2/contacts', [
            'body' => json_encode([
                'add' => [
                    [
                        'name' => $data['name'],
                        'email' => 'thanksyougott@gmail.com',
                        'responsible_user_id' => $user->id,
                        'created_by' => $user->id,
                        'created_at' => Carbon::now()->timestamp,
                        'leads_id' => [$data['lead_id']],
                        'company_name' => $data['company'],
                        'custom_fields' => $fields
                    ]
                ]
            ])
        ]);
    }
}
