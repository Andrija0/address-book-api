<?php

use Illuminate\Database\Seeder;

class AgencyContactSeeder extends Seeder
{
    const AGENCY_CONTACTS = [
        [
            'name' => 'White City Soft',
            'address' => 'Cika Ljubina 14',
            'city' => 'Belgrade',
            'phone_numbers' => [
                '060/7050117',
                '060/7050118'
            ],
            'email' => 'info@whitecitysoft.com',
            'web' => 'https://whitecitysoft.com/',
            'contacts' => [
                [
                    'first_name' => 'Andrija',
                    'last_name' => 'Gligorijevic',
                    'email' => 'andrijagligorijevic@gmail.com',
                    'web' => 'gligorijevic.com',
                    'phone_numbers' => [
                        '060/7050119',
                        '060/7050120'
                    ],
                    'professions' => [
                        'Developer',
                        'Lawyer',
                    ]
                ]
            ]

        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::AGENCY_CONTACTS as $agencyData) {
            $agency = factory(\App\Agency::class)->create([
                'name' => $agencyData['name'],
                'address' => $agencyData['address'],
                'city_id' => \App\City::where('city', $agencyData['city'])->first()->id,
                'email' => $agencyData['email'],
                'web' => $agencyData['web'],
            ]);
            foreach ($agencyData['phone_numbers'] as $phoneNumber) {
                $phone = \App\PhoneNumber::make(['phone_number' => $phoneNumber]);
                $agency->phoneNumbers()->save($phone);
            }

            foreach ($agencyData['contacts'] as $contactData) {
                $contact = factory(\App\Contact::class)->create([
                    'first_name' => $contactData['first_name'],
                    'last_name' => $contactData['last_name'],
                    'agency_id' => $agency->id,
                    'email' => $contactData['email'],
                    'web' => $contactData['web'],
                    'user_id' => \App\User::where('email', $contactData['email'])->first()->id
                ]);

                foreach ($contactData['phone_numbers'] as $phoneNumber) {
                    $phone = factory(\App\PhoneNumber::class)->make(['phone_number' => $phoneNumber]);
                    $contact->phoneNumbers()->save($phone);
                }

                foreach ($contactData['professions'] as $professionData) {
                    $contact->professions()->attach(\App\Profession::where('profession', $professionData)->first());
                }
            }
        }
    }
}
