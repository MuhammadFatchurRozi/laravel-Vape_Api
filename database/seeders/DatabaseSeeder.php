<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{
    User, 
    product_category, 
    product, 
    product_img, 
    cart, 
    vendor, 
    superadmin, 
    pengelola, 
    customer
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        product_category::factory(25)->create();
        product::factory(20)->create();
        product_img::factory(10)->create();
        cart::factory(15)->create();
        vendor::factory(10)->create();
        superadmin::factory(10)->create();
        pengelola::factory(10)->create();
        customer::factory(10)->create();
    }
}
