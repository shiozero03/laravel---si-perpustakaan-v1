<?php

namespace Database\Factories;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Buku::class;

    public function definition(): array
    {
        return [
            'no_panggil' => $this->faker->unique()->randomNumber(9, true),
            'judul_buku' => $this->faker->name(),
            'cover_buku' => 'buku.png',
            'pengarang' => $this->faker->name(),
            'penerbit' => $this->faker->name(),
            'tahun_terbit' => $this->faker->randomNumber(4, true),
            'tempat_terbit' => $this->faker->city(),
            'halaman' => $this->faker->randomNumber(3, true),
            'bahasa' => 'English',
            'sinopsis' => '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'status' => 'Tersedia',
            'rating' => 0,
            'jumlah_penilai' => 0,
            'total_rate' => 0
        ];
    }
}
