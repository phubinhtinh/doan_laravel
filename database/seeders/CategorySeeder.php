<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tailored Outerwear',
                'slug' => 'tailored-outerwear',
                'description' => 'Architectural coats and blazers crafted from the finest materials.',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuADPeWjvlME49dW1Rc6UvdbzxK_PzOdacnTeQuyUHRfJxEsBTtDx-maOkaor1Ag-3x7o5AMQI5PEBFaHaWxf0IkAZLupoxc3CD8-xo1icRMrzQsbREWs39e4LtXLhC7qTVs09mj3kblasuT8NFp1Xp_1KfQ4ItojNucjfkTdcHafNQUXdgLwlpi8whpxooPMMEarNfEug4llzhRyLXzOF2YDydn3vQmVbsA0vqvGuMovg542wdJ3pi8UcfHKFelZAJzN1aSfO6AGjTi',
            ],
            [
                'name' => 'Silk Separates',
                'slug' => 'silk-separates',
                'description' => 'Fluid silk pieces that embody effortless elegance.',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDfmD4RTJC55nGc1x4tOiFVI3w7_JoHqUOEy1rZ6p7op1A-5mi-IQHE7c_kuCvLDibBejH0Ds4k7-c5z5DCQSefKyjueABLgDb4IARAZ50enO7C4F_z_bhEJNPp0K3j7oFpFeIItLckUJOvIwwnF32kJ3ZEx15Z1YPLFnlKOopXeAM0JUSks8_B4W68jsLKj6plZY8xqt6JK6YV_LyrjNWjpRVzxv2xgEjbMvMxA7aG0QQZfJPH2lw77Kvxl2CDQh0IaEmufvVIegFb',
            ],
            [
                'name' => 'Essential Knits',
                'slug' => 'essential-knits',
                'description' => 'Luxurious knitwear made from cashmere and merino wool.',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBgkKkeQEKZNb5zoCgdZKIQYP25obFmma4Gv0ZoRTnHzE7OektlO7f4YkX4gRMVb2jV-fStVq484cJJJ7IXXs0rNnMt5TrIBosvw0P4FS0dwjPsCLFCqmmmAAgfSjyMcTJJsUZwPbDxRqGXEO7VkB5fZU15NfhShieVz7ORJo2T8RcxiGb_5P-cp9RLCx-erLiEHCtt0dKgUG__iPun5jnOJ2vPkevmi3-b4CWcTnrY-pu4DVNrrOauBb-XYSsNkTe5nyA4e7X_D-iV',
            ],
            [
                'name' => 'Evening Gowns',
                'slug' => 'evening-gowns',
                'description' => 'Statement pieces for the most distinguished occasions.',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAhjvYZ2RRDkJ1W93z-d0KV8pxqG6BtvhU0hvyeIh2l_IaMIJLBFMU9n-yYgKydZ-i3ESFzanuzQYEOwbDG-GyOgDa3bwrBTzK6XPlzP5PhVFjqv91jbWf-EkfXviavSOtyTc2q2_ripRGZm0xyZFuRaWL5awT2PEM_5MHyG_52KeugEwCSpbqCcfHRQF3UDSm3FO_V8-sMuZaRJz5t8jkD05KDNBpGuRb3IMRBW_9HYFhGwwX2UAcCiFt-oYFIzfgRHiO09OCM0vVP',
            ],
            [
                'name' => 'Artisanal Accessories',
                'slug' => 'artisanal-accessories',
                'description' => 'Sculptural objects of desire — bags, shoes, and jewellery.',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCJx-4m1Q9cjvx_-wkGRGIVUAfdQh0PT-YxWvjp6Y5G6dySzU4imU0y9x5uHW4AxCmPPUlBQNytewEi0jmaZBjkr1Yw9AhwHiMu8NcySUB40D7tMdaVvGkTaDoLVw4floH8cs9Wf5FX8SGft-ns2kjC1tFdj8LxY-hBM149V3bI4ePRb3H1HtorIWdrkjweB9vvIwvUSEez5iDptSnCY1QYHMAwGqFsivup-QfkVysGBm-yp5E8HUrqkJPtEMfTre4yPmR5ZKD75AKD',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
