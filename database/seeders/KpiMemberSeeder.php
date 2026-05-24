<?php

namespace Database\Seeders;

use App\Models\KpiMember;
use Illuminate\Database\Seeder;

class KpiMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            // Project Manager
            ['Fellix Fernando Williams Lim',    'Project Manager',        ['Periode Week 1-4' => 1004, 'Periode Week 5-8' => 1003, 'Periode Week 9-12' => 1040]],
            ['Mikael Geraldius Gunawan',         'Project Manager',        ['Periode Week 1-4' => 1004, 'Periode Week 5-8' =>  831, 'Periode Week 9-12' =>  915]],
            ['Rafi Athallah Ahmad Haryanto',     'Project Manager',        ['Periode Week 1-4' => 1000, 'Periode Week 5-8' => 1001, 'Periode Week 9-12' => 1067]],
            ['Carmelo Anthony',                  'Project Manager',        ['Periode Week 1-4' => 1000, 'Periode Week 5-8' =>  916, 'Periode Week 9-12' => 1048]],
            ['Clemens Putra Kusmeri',            'Project Manager',        ['Periode Week 1-4' =>  500, 'Periode Week 5-8' =>  915, 'Periode Week 9-12' => 1018]],
            ["Muhammad Farras Mu'tashim",        'Project Manager',        ['Periode Week 1-4' => 1000, 'Periode Week 5-8' => 1003, 'Periode Week 9-12' => 1049]],
            ['Jonah Matthew Santoso',            'Project Manager',        ['Periode Week 1-4' =>  976, 'Periode Week 5-8' => 1003, 'Periode Week 9-12' => 1053]],
            ['Aurelio Atthaya Suwisar',          'Project Manager',        ['Periode Week 1-4' => 1002, 'Periode Week 5-8' => 1002, 'Periode Week 9-12' => 1040]],
            ['Mickael Sahala',                   'Project Manager',        ['Periode Week 1-4' => 1000, 'Periode Week 5-8' =>  872, 'Periode Week 9-12' =>  998]],
            // Creative
            ['Angela Benedictin Sunny',          'Creative',               ['Periode Week 1-4' => 1020, 'Periode Week 5-8' => 1027, 'Periode Week 9-12' => 1079]],
            ['Faathin Naufal',                   'Creative',               ['Periode Week 1-4' => 1033, 'Periode Week 5-8' =>  819, 'Periode Week 9-12' =>  687]],
            ['Desslyn Marcela',                  'Creative',               ['Periode Week 1-4' => 1015, 'Periode Week 5-8' => 1029, 'Periode Week 9-12' => 1053]],
            ['Dhita Paramita Citra',             'Creative',               ['Periode Week 1-4' => 1020, 'Periode Week 5-8' =>  852, 'Periode Week 9-12' => 1081]],
            ['Naufal Rabbani',                   'Creative',               ['Periode Week 1-4' => 1033, 'Periode Week 5-8' => 1033, 'Periode Week 9-12' =>  885]],
            ['Abraham Immanuel Soerjana',        'Creative',               ['Periode Week 1-4' => 1025, 'Periode Week 5-8' =>  907, 'Periode Week 9-12' =>  415]],
            // Finance
            ['Rafael Romelo Gibran',             'Finance',                ['Periode Week 1-4' => 1008, 'Periode Week 5-8' =>  909, 'Periode Week 9-12' =>  779]],
            ['Rorensia Verisca',                 'Finance',                ['Periode Week 1-4' => 1003, 'Periode Week 5-8' => 1002, 'Periode Week 9-12' => 1058]],
            ['Shalomita Amanda Christy Lasamahu','Finance',                ['Periode Week 1-4' =>  670, 'Periode Week 5-8' =>  949, 'Periode Week 9-12' => 1068]],
            ['Ritz Kevin',                       'Finance',                ['Periode Week 1-4' =>  993, 'Periode Week 5-8' =>  994, 'Periode Week 9-12' => 1036]],
            ['Roane Adzani Sukmayadi Jaya',      'Finance',                ['Periode Week 1-4' => 1003, 'Periode Week 5-8' =>  879, 'Periode Week 9-12' =>  702]],
            ['Lexion Rafael',                    'Finance',                ['Periode Week 1-4' => 1000, 'Periode Week 5-8' => 1011, 'Periode Week 9-12' =>  921]],
            // Research and Development
            ['Aditya Zianur Rahman Setiadi',     'Research and Development', ['Periode Week 1-4' => 1023, 'Periode Week 5-8' => 1010, 'Periode Week 9-12' =>  878]],
            ['Rezie Andriano',                   'Research and Development', ['Periode Week 1-4' => 1021, 'Periode Week 5-8' => 1003, 'Periode Week 9-12' => 1059]],
            ['Gavriel Donovan',                  'Research and Development', ['Periode Week 1-4' => 1010, 'Periode Week 5-8' => 1007, 'Periode Week 9-12' =>  921]],
            ['Titus Ericson Bianto',             'Research and Development', ['Periode Week 1-4' => 1021, 'Periode Week 5-8' => 1000, 'Periode Week 9-12' =>  874]],
            ['Eryel Maseya Putra',               'Research and Development', ['Periode Week 1-4' => 1021, 'Periode Week 5-8' => 1003, 'Periode Week 9-12' => 1023]],
            ['Vincent',                          'Research and Development', ['Periode Week 1-4' => 1034, 'Periode Week 5-8' => 1003, 'Periode Week 9-12' => 1016]],
            // Human Resource
            ['Vijie Annisa Dzatil Izzah',        'Human Resource',         ['Periode Week 1-4' =>  627, 'Periode Week 5-8' =>  948, 'Periode Week 9-12' => 1018]],
            // Public Relation
            ['Vincent Andresson',                'Public Relation',        ['Periode Week 1-4' => 1021, 'Periode Week 5-8' =>  800, 'Periode Week 9-12' => 1014]],
            ['Jesslyn Claresta Sanders',         'Public Relation',        ['Periode Week 1-4' => 1015, 'Periode Week 5-8' => 1003, 'Periode Week 9-12' => 1013]],
            ['Christian Valentino',              'Public Relation',        ['Periode Week 1-4' =>  980, 'Periode Week 5-8' =>  988, 'Periode Week 9-12' => 1024]],
            ['Nadine Angeline',                  'Public Relation',        ['Periode Week 1-4' =>  962, 'Periode Week 5-8' =>  977, 'Periode Week 9-12' =>  967]],
            ['Kelyn Sorensia',                   'Public Relation',        ['Periode Week 1-4' =>  871, 'Periode Week 5-8' =>  998, 'Periode Week 9-12' => 1031]],
            // Badan Pengurus Harian
            ['Gerald Alfons',                    'Badan Pengurus Harian',  ['Periode Week 1-4' => 1010, 'Periode Week 5-8' =>  977, 'Periode Week 9-12' =>  679]],
            ['Ardifa Rizky Saputra',             'Badan Pengurus Harian',  ['Periode Week 1-4' => 1006, 'Periode Week 5-8' =>  831, 'Periode Week 9-12' =>  610]],
            ['Victor Chandra',                   'Badan Pengurus Harian',  ['Periode Week 1-4' => 1000, 'Periode Week 5-8' =>  994, 'Periode Week 9-12' =>  984]],
            ['Keisha Aria Lai',                  'Badan Pengurus Harian',  ['Periode Week 1-4' => 1010, 'Periode Week 5-8' => 1009, 'Periode Week 9-12' =>  984]],
        ];

        foreach ($members as [$name, $division, $history]) {
            $member = KpiMember::create([
                'name'     => $name,
                'division' => $division,
                'overall'  => array_sum($history),
            ]);
            foreach ($history as $periodName => $score) {
                $member->periods()->create(['period_name' => $periodName, 'score' => $score]);
            }
        }
    }
}
