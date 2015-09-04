<?php

use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        //User
        $userEmail = 'seeder@laraticket.com';
        $user = \App\User::where('email',$userEmail)->first();
        if(!$user){
            $user = new \App\User();
            $user->email = $userEmail;
            $user->save();
        }

        //Clients
        $clients = [];
        $client_ids = [];
        for($i=0;$i<10;$i++){
            $client = new \App\Client();
            $client->name = $faker->company;
            $client->save();
            $client_ids[] = $client->id;
        }

        //Tickets
        for($i=0;$i<50;$i++){
            $ticket = new \App\Ticket();
            $ticket->user_id = $user->id;
            $ticket->client_id = $client_ids[array_rand($client_ids)];
            $ticket->status_id = \App\Status::orderByRaw('RAND()')->first()->id;
            $ticket->priority = rand(1,10);
            $ticket->title = $faker->sentence;
            $ticket->description = $faker->paragraph;
            $ticket->save();
        }
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
