<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languages = ['English', 'Spanish', 'French', 'German', 'Italian', 'Japanese', 'Chinese', 'Russian', 'Arabic', 'Hindi'];
        $genere = ['Arts & Photography','Boxed Sets','Fiction and Literature','Foreign Languages','History',' Biography',' Social Science','Kids and Teens,Learning and Reference','Lifestyle and Wellness','Manga and Graphic Novels',"Miscellaneous",'Nature','Nepali','Rare Coffee Table Books','Religion','Self Improvement and Relationships','Spirituality and Philosophy','Technology','Travel'];

        return [
            //
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'publication_year' => (string) $this->faker->year,
            'price'=> $this->faker->numberBetween(100,1000),
            'page_no' => $this->faker->numberBetween(100,1000),
            'language' => $this->faker->randomElement($languages),
            'isbn' => $this->faker->numberBetween(1111111111111,9999999999999),
            'genere' => $this->faker->randomElement($genere),
        ];
    }
}





