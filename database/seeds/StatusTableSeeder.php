<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name' => 'New',
                'weight' => '0',
            ],
            [
                'name' => 'Pending',
                'weight' => '10',
            ],
            [
                'name' => 'Resolved',
                'weight' => '20',
                'billable' => true,
            ],
            [
                'name' => 'Archived',
                'weight' => '30',
                'billable' => true,
                'archivable' => true,
            ],
        ];
        foreach($statuses as $statusData){
            $status = \App\Status::where('name',$statusData['name'])->first();
            if(!$status){
                $status = new \App\Status();
                $status->put($statusData);
            }
        }
    }
}
