<?php

use Illuminate\Database\Seeder;
use TGLD\Projects\Project;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['my broken phone', 'island tough', 'hush hush', 'task manager', 'jmass'];
        $slug = ['my-broken-phone', 'island-tough', 'hush-hush', 'task-manager', 'jmass'];

        foreach(range(0, 3) as $index)
        {
            Project::create([
                'title' => $titles[$index],
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat pharetra leo quis pharetra. Duis porttitor mauris sed tellus iaculis, et tincidunt ante malesuada. Aenean neque lectus, efficitur egestas tellus a, semper tempus nisl. Fusce ut quam congue, molestie nibh sed, dapibus turpis. In varius dapibus aliquet. Donec vestibulum dolor risus, et pellentesque lectus porta non. Nulla facilisi. Suspendisse potenti. Pellentesque rhoncus lobortis tellus, non vehicula purus dictum sit amet. Donec at ipsum non nibh volutpat laoreet. Etiam dolor arcu, convallis aliquam pharetra at, consequat ',
                'slug' => $slug[$index],
            ]);
        }
    }
}