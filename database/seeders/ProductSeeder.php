<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Category 1: Tailored Outerwear
            [
                'category_id' => 1,
                'name' => 'Structured Wool Blazer',
                'slug' => 'structured-wool-blazer',
                'description' => 'A definitive expression of architectural purity. Crafted from ethically sourced double-faced virgin wool, featuring hand-finished seams and a sharp, structured silhouette.',
                'price' => 1850.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuADPeWjvlME49dW1Rc6UvdbzxK_PzOdacnTeQuyUHRfJxEsBTtDx-maOkaor1Ag-3x7o5AMQI5PEBFaHaWxf0IkAZLupoxc3CD8-xo1icRMrzQsbREWs39e4LtXLhC7qTVs09mj3kblasuT8NFp1Xp_1KfQ4ItojNucjfkTdcHafNQUXdgLwlpi8whpxooPMMEarNfEug4llzhRyLXzOF2YDydn3vQmVbsA0vqvGuMovg542wdJ3pi8UcfHKFelZAJzN1aSfO6AGjTi',
                'image2' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBG2UK6pmiaPiqdL_FIFoE0MT7tPH4lc3WFdSPo9FY3AlZampxFrtkMZaHTDtcjqeZeQ2tCfg_jt7J0a09e9pZRvhzxtzXdZbo6024w44auqcut1kevEN6VP5a8nKyggEyyrin0r8B89ZxF34u1D0FTS2MnZD0KBUPf0R3FO4pnQke9EM7q4b0Y10MTr0IQBg_Cojaqj6BAHjSvrXDGfv-fYw44csTflh8ggBc28KMnXc4S9MxItPCoHjEWRtwGmb2XIdxgCsQm2htL',
                'image3' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAXnMsekK3OBXXGa8liDuRYkxgG31UTRDDQ35X6ySQnZ-Q2PgWUdZGwzzJUFV3JF7GQ9DQHQmgMT2yWq0r9jG1fENm1vHEC9mwivsYKtX1NEaRLKZufb_Qh55YXWHIb72h7t68nPfVJMdh3GHTPzt8RnUbQh7Rl4w7pYfQGYBMxGwunWEXvpHzdCk6IGd03uUeevmuYDh01MQp3d4bDG-khi_QLSPifZMlymqw6P5WCWFDQ2DT3Mqpbp-Tz6UToIifNiyKeHMFsmqUo',
                'color' => 'Deep Charcoal',
                'size_options' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 25,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Archetype Tailored Coat',
                'slug' => 'archetype-tailored-coat',
                'description' => 'A definitive expression of the Atelier\'s commitment to architectural purity. Crafted from ethically sourced double-faced virgin wool, featuring hand-finished seams and a sharp, structured silhouette.',
                'price' => 2450.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD34Hoot6kuc2n5W4toHcu26APTR-6GpiyGeJy-HukfuwwceQnOWFWTlwZHkBm5RtSAoNX_DeWCvAE-7CEOFFDOUIPvdK_VH9FPhu1pIR6tDkpZQzl49Nubju4reXIDDKH_IceN_ckMbCRbHYDBsj-Vb-fLLGnZ4toaV8a3t89et2TUSlguOiCXnCfvCTlO4ILobNT0uC7D3l-vCVHXNRFZHsG6YxJveQa1jD3TbaTCmg3P8u-gzmC2P3ZrAzpk3CXjUpAvy5-kcdWn',
                'image2' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBG2UK6pmiaPiqdL_FIFoE0MT7tPH4lc3WFdSPo9FY3AlZampxFrtkMZaHTDtcjqeZeQ2tCfg_jt7J0a09e9pZRvhzxtzXdZbo6024w44auqcut1kevEN6VP5a8nKyggEyyrin0r8B89ZxF34u1D0FTS2MnZD0KBUPf0R3FO4pnQke9EM7q4b0Y10MTr0IQBg_Cojaqj6BAHjSvrXDGfv-fYw44csTflh8ggBc28KMnXc4S9MxItPCoHjEWRtwGmb2XIdxgCsQm2htL',
                'image3' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAXnMsekK3OBXXGa8liDuRYkxgG31UTRDDQ35X6ySQnZ-Q2PgWUdZGwzzJUFV3JF7GQ9DQHQmgMT2yWq0r9jG1fENm1vHEC9mwivsYKtX1NEaRLKZufb_Qh55YXWHIb72h7t68nPfVJMdh3GHTPzt8RnUbQh7Rl4w7pYfQGYBMxGwunWEXvpHzdCk6IGd03uUeevmuYDh01MQp3d4bDG-khi_QLSPifZMlymqw6P5WCWFDQ2DT3Mqpbp-Tz6UToIifNiyKeHMFsmqUo',
                'color' => 'Anthracite',
                'size_options' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 15,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'The Signature Overcoat',
                'slug' => 'the-signature-overcoat',
                'description' => 'Hand-finished Italian wool with silk lining. Our most iconic piece, featuring sharp shoulders and a fluid drape.',
                'price' => 2450.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBx_JqRkMx5ovRZ_yNu1maQiyu7TJvBSQ8MMfZihHCll7L-qD4FPlHvpw432G57q04fnjGzlYxg6lDRvtlpKQpwizMweFaY5YJfh6oe71DLq6rRlMp_sVOIt6VPQPBESIWVd3mMsjmZwCtQKFX2F_NZX4zaqHbON9-dKH-nKluXhHMjeGBjuS0aoxi5SDfUmmE8XP0yqGETuFv3M_b0Z6RnoLe7JcKL7psf0XLBXngB9OmnRUj2Amom4IgPmMvKhzWaZv7q0IPoOGTQ',
                'color' => 'Camel Cashmere',
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock' => 10,
                'is_featured' => true,
            ],

            // Category 2: Silk Separates
            [
                'category_id' => 2,
                'name' => 'Fluid Silk Blouse',
                'slug' => 'fluid-silk-blouse',
                'description' => 'Pure mulberry silk with a lustrous finish. Relaxed fit with French seams throughout.',
                'price' => 890.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDfmD4RTJC55nGc1x4tOiFVI3w7_JoHqUOEy1rZ6p7op1A-5mi-IQHE7c_kuCvLDibBejH0Ds4k7-c5z5DCQSefKyjueABLgDb4IARAZ50enO7C4F_z_bhEJNPp0K3j7oFpFeIItLckUJOvIwwnF32kJ3ZEx15Z1YPLFnlKOopXeAM0JUSks8_B4W68jsLKj6plZY8xqt6JK6YV_LyrjNWjpRVzxv2xgEjbMvMxA7aG0QQZfJPH2lw77Kvxl2CDQh0IaEmufvVIegFb',
                'color' => 'Ivory Satin',
                'size_options' => ['XS', 'S', 'M', 'L'],
                'stock' => 30,
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Draped Silk-Cashmere Blouse',
                'slug' => 'draped-silk-cashmere-blouse',
                'description' => 'A blend of silk and cashmere creating the ultimate soft drape. Ideal for transitional layering.',
                'price' => 620.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA5u1KDLEtHpKFL5jatYflnk8C6FG59wnErWtzoj62N2GUxCvDdXzAcQLMOJTUe4AkRomdbAQ1A6Y4DZN6QSihUI0vbKLm3CUeorHaGSH3hqau2fILOWEAG2U-9vGzhLVvyVNUSjUwnds-GSCMlmUpYqtUO0PV3Sbb9_rgkf_-rYC77M7frAAhg5uapW9qZmnWp1xSuvF_sqI29uMp3w5Yj6wgJF3R0qvLQwZtB2OhyVrZM3V-F3GXLT_bNTbPIAXsN2jA3dd0MgbMm',
                'color' => 'Ivory',
                'size_options' => ['XS', 'S', 'M', 'L', 'XL'],
                'stock' => 20,
                'is_featured' => false,
            ],
            [
                'category_id' => 2,
                'name' => 'Silk Utility Trouser',
                'slug' => 'silk-utility-trouser',
                'description' => 'Luxurious silk twill trousers with utilitarian details. A modern wardrobe essential.',
                'price' => 1150.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD8mGMW7xv8rGWFos20ni2ifOySnivoK-w02U-jYkwiXKgzLylzQaLbz0qfSoStaTcPwWkx6vuI7Eb64CQD8Y_P6slxwxjU2LAMODkAP9gT8tfNXzueOzpdEOhlURsowfP9lqz8U_N6fE9pq_nfaKQMhjjQNhkDLm-sgJDkKL-E3jcSPsc7yrT8FU75f3ANJxqIZL6in17QGen9ca5kQTgjxDIdKB0Ixn4_rOWhlBmcnyoIuHfOX21UMT4lXFGBkDIIVVxEMFwDkP16',
                'color' => 'Sand Melange',
                'size_options' => ['S', 'M', 'L'],
                'stock' => 18,
                'is_featured' => false,
            ],

            // Category 3: Essential Knits
            [
                'category_id' => 3,
                'name' => 'Heavyweight Rib Knit',
                'slug' => 'heavyweight-rib-knit',
                'description' => 'Chunky ribbed cashmere sweater, perfect for winter layering. Hand-knitted in Scotland.',
                'price' => 890.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBgkKkeQEKZNb5zoCgdZKIQYP25obFmma4Gv0ZoRTnHzE7OektlO7f4YkX4gRMVb2jV-fStVq484cJJJ7IXXs0rNnMt5TrIBosvw0P4FS0dwjPsCLFCqmmmAAgfSjyMcTJJsUZwPbDxRqGXEO7VkB5fZU15NfhShieVz7ORJo2T8RcxiGb_5P-cp9RLCx-erLiEHCtt0dKgUG__iPun5jnOJ2vPkevmi3-b4CWcTnrY-pu4DVNrrOauBb-XYSsNkTe5nyA4e7X_D-iV',
                'color' => 'Charcoal',
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock' => 22,
                'is_featured' => false,
            ],
            [
                'category_id' => 3,
                'name' => 'Ribbed Merino Knit',
                'slug' => 'ribbed-merino-knit',
                'description' => 'Fine merino wool knitted in a classic rib stitch. Timeless versatility.',
                'price' => 890.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBdXbvB7fJ7XkkcDmR4BJVrm7GetDO1fHv-drznRYB678ObASW1qNs-OSn8SQFIz6UaQDXgRDUBivKMTi7TF2rOLDkLE1GNoYfqIez0B1gArLd3s6Qr8rfAr4y-HbBCoZ4W2fUDEVmaqS3B35RkXWqOOqjWKjGA96o_Vn7s5jlnFt6Hdxl5Y7hFWQL06ZHjpjMY60ZmV_C68PRs2OQqETNPoOH7Y3tLkwDLiL_VA5xDwS8z2s7dGu30jLdGvr1pw5m5iN3ofKmC5wXb',
                'color' => 'Oatmeal',
                'size_options' => ['XS', 'S', 'M', 'L'],
                'stock' => 30,
                'is_featured' => false,
            ],

            // Category 4: Evening Gowns
            [
                'category_id' => 4,
                'name' => 'Pleated Midi Dress',
                'slug' => 'pleated-midi-dress',
                'description' => 'A cascading pleated silk dress in vibrant saffron. Show-stopping silhouette for evening occasions.',
                'price' => 3200.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAhjvYZ2RRDkJ1W93z-d0KV8pxqG6BtvhU0hvyeIh2l_IaMIJLBFMU9n-yYgKydZ-i3ESFzanuzQYEOwbDG-GyOgDa3bwrBTzK6XPlzP5PhVFjqv91jbWf-EkfXviavSOtyTc2q2_ripRGZm0xyZFuRaWL5awT2PEM_5MHyG_52KeugEwCSpbqCcfHRQF3UDSm3FO_V8-sMuZaRJz5t8jkD05KDNBpGuRb3IMRBW_9HYFhGwwX2UAcCiFt-oYFIzfgRHiO09OCM0vVP',
                'color' => 'Saffron Silk',
                'size_options' => ['XS', 'S', 'M', 'L'],
                'stock' => 8,
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Wide-Leg Trouser',
                'slug' => 'wide-leg-trouser',
                'description' => 'Flowing wide-leg trousers in a soft sand melange. Perfect for sophisticated evening ensembles.',
                'price' => 1100.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBKVrhTHwh-Jcg_XvJu81oIEAcMJRO1up_Js3CRQ7Cmt-bmHvNHPWnS_bVHUg4MJfuZAkyCqx8Za-1Z0bIkpmI_aYtYwRs5bb8JK-GKCW7rFDN7o1Vjx1RNCo4tVS6Y6tRiaw0XQtXViO4Y8j_MjhxwVeD2Elc5cZwbM3qLE34A-ZVdjhBURPyilEJ3IhTk-GUiFrxWeP1JRrE_MA8mYj3bmMmoof14lybXX4g-0H8aKgntmxl54x70IloV9t94-W93hnWdV5woCSeY',
                'color' => 'Sand Melange',
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock' => 20,
                'is_featured' => false,
            ],

            // Category 5: Artisanal Accessories
            [
                'category_id' => 5,
                'name' => 'The Atelier Tote',
                'slug' => 'the-atelier-tote',
                'description' => 'Structured tote in grained calfskin leather. Gold-tone hardware and suede interior.',
                'price' => 2400.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCJx-4m1Q9cjvx_-wkGRGIVUAfdQh0PT-YxWvjp6Y5G6dySzU4imU0y9x5uHW4AxCmPPUlBQNytewEi0jmaZBjkr1Yw9AhwHiMu8NcySUB40D7tMdaVvGkTaDoLVw4floH8cs9Wf5FX8SGft-ns2kjC1tFdj8LxY-hBM149V3bI4ePRb3H1HtorIWdrkjweB9vvIwvUSEez5iDptSnCY1QYHMAwGqFsivup-QfkVysGBm-yp5E8HUrqkJPtEMfTre4yPmR5ZKD75AKD',
                'color' => 'Grained Calfskin',
                'size_options' => ['One Size'],
                'stock' => 12,
                'is_featured' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Orbit Stiletto',
                'slug' => 'orbit-stiletto',
                'description' => 'Sculptural stiletto heel in metallic silver leather. Italian craftsmanship at its finest.',
                'price' => 1250.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCLQPhyXbWZcWovEoAo0UaTYPPsRp54DkgCUjfNTvJtji6NLIylzEcL0PaOIeI6ysy73Th3-P9wMqSru_-KUnxg5_qMcG9LyAbezj9FlSaRu2eCYUxMnGaaK8N-_nWIkYiJZGkuV618p8H6Fy1bJlGbjJjanIMj47k_KYO6wxTa0KvRA2e4jusdSgTzKV2rVHbJN0WNgmmkS5jaKuS_H7w-9flqWbeDMewTJWygh5DXQ4ly81BjdsMV5OzS2Qk3M_j_gAiczxW6y_uQ',
                'color' => 'Metallic Silver',
                'size_options' => ['36', '37', '38', '39', '40', '41'],
                'stock' => 15,
                'is_featured' => false,
            ],
            [
                'category_id' => 5,
                'name' => 'Polished Ankle Boot',
                'slug' => 'polished-ankle-boot',
                'description' => 'Calf leather with signature brushed finish. Goodyear-welted construction for lasting durability.',
                'price' => 1200.00,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB4BG3ANQiX8n-j9bpWE1XkTFIBMX5VuF5CJr82UXGdpsljuSt2bq8hULwCsW-3wEsrwJHQZqTSanrSkEV_vQaPcq0I8rsNz7qAzpT-tlMvgnp9e9WePkhkPbiibLTWjnAs6M3bpKgPLf-7AafE4gtxPpAYDakpEN0hkux9J-soD3R2Q2DgAvYxzrGbXC5Q1xJLRro9pfyFqde7R_aw2WKQ6F2mZdw2-yLd2U4KMF3Id57dTn24iSc0Xr8UCfnvZTcOltIqYeUpiXFZ',
                'color' => 'Obsidian',
                'size_options' => ['38', '39', '40', '41', '42', '43'],
                'stock' => 20,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
