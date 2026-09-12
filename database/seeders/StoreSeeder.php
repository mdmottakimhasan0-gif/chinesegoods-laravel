<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@chinesegoodsbd.test'],
            [
                'name' => 'Store Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        $categories = [
            ['Tools & Hardware', 'টুলস ও হার্ডওয়্যার', 'tools-hardware', true, 1, '🧰'],
            ['Coin & Hobby', 'কয়েন ও হবি', 'coin-hobby', true, 2, '🪙'],
            ['Mobile Accessories', 'মোবাইল এক্সেসরিজ', 'mobile-accessories', true, 3, '📱'],
            ['Home & Kitchen Item', 'হোম ও কিচেন', 'home-kitchen-item', true, 4, '🏠'],
            ["Man's Item", 'ম্যানস আইটেম', 'mans-item', true, 5, '👔'],
            ['Computer Accessories', 'কম্পিউটার এক্সেসরিজ', 'computer-accessories', true, 6, '💻'],
            ['Gift & Showpiece', 'গিফট ও শোপিস', 'gift-showpiece', true, 7, '🎁'],
            ['Jewelary & Stones', 'জুয়েলারি', 'jewelary-stones', false, 8, '💎'],
            ['Stationery', 'স্টেশনারি', 'stationery', false, 9, '📚'],
            ['Beauty & Cosmetics', 'বিউটি ও কসমেটিক্স', 'beauty-cosmetics', true, 10, '💄'],
            ['DIY Project', 'ডিআইওয়াই প্রজেক্ট', 'diy-project', false, 11, '🛠️'],
            ["Toy's", 'খেলনা', 'toys', false, 12, '🧸'],
            ['Electronics & Gadgets', 'ইলেকট্রনিক্স', 'electronics-gadgets', true, 13, '🔌'],
            ['Best selling', 'বেস্ট সেলিং', 'best-selling', false, 14, '⭐'],
        ];

        $catModels = [];
        foreach ($categories as [$name, $bn, $slug, $top, $sort, $icon]) {
            $catModels[$slug] = Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'name_bn' => $bn,
                    'image' => 'https://picsum.photos/seed/'.$slug.'/240/240',
                    'icon' => $icon,
                    'is_top' => $top,
                    'sort_order' => $sort,
                ]
            );
        }

        $products = [
            [
                'name' => 'Rose Elegance Stainless Steel Spoon & Fork Set Gift Boxed',
                'price' => 199, 'compare' => 300,
                'cats' => ['gift-showpiece', 'home-kitchen-item'],
                'img' => 'https://images.unsplash.com/photo-1590794056226-79ef3a8147e1?w=800&q=80',
                'sale' => true, 'new' => true,
                'desc' => 'Gift boxed stainless steel spoon and fork set for dining and gifting.',
            ],
            [
                'name' => 'Day-based fashion earrings set, Trendy Ear Ring for Girl',
                'price' => 199, 'compare' => 300,
                'cats' => ['beauty-cosmetics', 'gift-showpiece', 'jewelary-stones'],
                'img' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=800&q=80',
                'sale' => true,
                'desc' => 'Trendy day-based fashion earring set for girls and gifting.',
            ],
            [
                'name' => 'Colorful Diamond Fashionable Elegant Matching Watch',
                'price' => 399, 'compare' => 499,
                'cats' => ['best-selling', 'gift-showpiece', 'jewelary-stones'],
                'img' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=800&q=80',
                'best' => true, 'colors' => ['Black', 'Blue', 'Green', 'Red', 'Rose Pink'],
                'desc' => 'Elegant matching watch for wedding, party and event wear.',
            ],
            [
                'name' => 'Bracelet type stylish watch for smart girls',
                'price' => 299, 'compare' => 499,
                'cats' => ['best-selling', 'gift-showpiece', 'jewelary-stones'],
                'img' => 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?w=800&q=80',
                'best' => true, 'colors' => ['Green', 'Milky black', 'Milky White', 'Pink', 'Purple'],
                'desc' => 'Bracelet-style watch with multiple color options.',
            ],
            [
                'name' => 'Spaceman Decoration Show Piece',
                'price' => 499, 'compare' => 600,
                'cats' => ['gift-showpiece', 'toys'],
                'img' => 'https://images.unsplash.com/photo-1636690424408-bd0b92523d1b?w=800&q=80',
                'featured' => true,
                'desc' => 'Astronaut spaceman decorative showpiece for desk and home.',
            ],
            [
                'name' => 'Light Blue Dolphin Show piece',
                'price' => 699, 'compare' => 800,
                'cats' => ['gift-showpiece', 'toys'],
                'img' => 'https://images.unsplash.com/photo-1570481662006-a3a1374699e8?w=800&q=80',
                'desc' => 'Cute dolphin decorative showpiece.',
            ],
            [
                'name' => '3D Frog Toy Show piece',
                'price' => 269, 'compare' => 350,
                'cats' => ['gift-showpiece', 'toys'],
                'img' => 'https://images.unsplash.com/photo-1554456854-55a089fd4cb2?w=800&q=80',
                'colors' => ['Blue', 'Green', 'Pink', 'Purple', 'RGB', 'Yellow'],
                'desc' => '3D frog toy showpiece in multiple colors.',
            ],
            [
                'name' => 'Panda Toy For Gift And Decoration',
                'price' => 249, 'compare' => 350,
                'cats' => ['gift-showpiece', 'toys'],
                'img' => 'https://images.unsplash.com/photo-1564349683136-77e08dba1ef7?w=800&q=80',
                'desc' => 'Panda toy for gift and home decoration.',
            ],
            [
                'name' => 'Super Fast 3 in 1 Magnetic Charger for Phone, Watch and Air pods',
                'price' => 749, 'compare' => 1400,
                'cats' => ['best-selling', 'electronics-gadgets', 'mobile-accessories'],
                'img' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?w=800&q=80',
                'best' => true, 'featured' => true,
                'desc' => '3-in-1 magnetic wireless charger for phone, watch and earbuds.',
            ],
            [
                'name' => '2 in 1 Magnetic Charger, 20 Watt Wireless Charger',
                'price' => 599, 'compare' => 1200,
                'cats' => ['best-selling', 'electronics-gadgets', 'mobile-accessories'],
                'img' => 'https://images.unsplash.com/photo-1591290619762-d289a0389033?w=800&q=80',
                'best' => true, 'featured' => true,
                'desc' => '20W 2-in-1 magnetic wireless charger.',
            ],
            [
                'name' => 'AI Smart Pen, Scanning Dictionary Pen – Global Translation Edition (A26G)',
                'price' => 6999, 'compare' => 12000,
                'cats' => ['best-selling', 'electronics-gadgets'],
                'img' => 'https://images.unsplash.com/photo-1583485088034-697b5bc36b85?w=800&q=80',
                'best' => true, 'featured' => true, 'colors' => ['Black', 'Blue', 'White'],
                'desc' => 'Scanning dictionary pen with global translation support.',
            ],
            [
                'name' => 'Hair Ban For Kids',
                'price' => 199, 'compare' => 2500,
                'cats' => ['beauty-cosmetics', 'best-selling', 'gift-showpiece'],
                'img' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=800&q=80',
                'best' => true,
                'desc' => 'Colorful hair bands for kids.',
            ],
            [
                'name' => 'Double Display 12 Digit Calculator',
                'price' => 739, 'compare' => 1400,
                'cats' => ['best-selling', 'electronics-gadgets', 'stationery'],
                'img' => 'https://images.unsplash.com/photo-1587145820266-a5951ee6f620?w=800&q=80',
                'best' => true, 'featured' => true,
                'desc' => 'Desktop calculator with double display and 12 digits.',
            ],
            [
                'name' => '10 pieces Book cover A4 and 16k transparent self adhesive textbook cover',
                'price' => 449, 'compare' => 600,
                'cats' => ['best-selling', 'stationery'],
                'img' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=800&q=80',
                'best' => true, 'colors' => ['Size A4 (47*34)', 'Size: 16K (43*30)'],
                'desc' => "Product Name: Book cover A4 and 16k\nBrand Name: No Brand\nImporter: Chinese Goods\nOrigin: China",
            ],
            [
                'name' => 'Multifunctional Full 420 SS 21 in one Wire Puller',
                'price' => 669, 'compare' => 1200,
                'cats' => ['best-selling', 'tools-hardware'],
                'img' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=800&q=80',
                'best' => true,
                'desc' => '21 functions in one 420 stainless steel electrician tool.',
            ],
            [
                'name' => 'Multifunctional High Carbon 21 in one Wire Puller',
                'price' => 649, 'compare' => 1200,
                'cats' => ['best-selling', 'tools-hardware'],
                'img' => 'https://images.unsplash.com/photo-1581147036324-c1c89c2c8b5c?w=800&q=80',
                'best' => true,
                'desc' => 'High carbon 21-in-1 multifunctional wire stripper.',
            ],
            [
                'name' => 'Transparent wireless mouse. three mode office optical gaming mouse',
                'price' => 999, 'compare' => 1600,
                'cats' => ['best-selling', 'computer-accessories', 'electronics-gadgets'],
                'img' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=800&q=80',
                'featured' => true, 'colors' => ['ORANGE', 'Sky Blue'],
                'desc' => 'Rechargeable silent bluetooth mouse with LED lights.',
            ],
            [
                'name' => 'Labor Protection Gloves For Construction',
                'price' => 99, 'compare' => 150,
                'cats' => ['diy-project', 'tools-hardware'],
                'img' => 'https://images.unsplash.com/photo-1590496793929-36417d3117de?w=800&q=80',
                'desc' => 'Wear resistant nitrile rubber work gloves.',
            ],
            [
                'name' => 'Cross-border double-layer dried flower glass cup',
                'price' => 799, 'compare' => 1600,
                'cats' => ['gift-showpiece', 'home-kitchen-item'],
                'img' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?w=800&q=80',
                'featured' => true,
                'desc' => 'Real flower high temperature resistant double layer glass cup.',
            ],
            [
                'name' => '4 KOPECKE 1762 1 Yen, Meiji Restoration replica coin',
                'price' => 999, 'compare' => 2000,
                'cats' => ['best-selling', 'coin-hobby'],
                'img' => 'https://images.unsplash.com/photo-1621416894560-3d0c4e5f6c0a?w=800&q=80',
                'best' => true, 'featured' => true,
                'desc' => "Diameter: 32mm\nThickness: 2.5mm\nWeight: 16g\nMaterial: Copper\nImporter: chinesegoodsbd.com",
            ],
            [
                'name' => '10 Piece Mixed World Coins Set with Red Drawstring Pouch',
                'price' => 799, 'compare' => 1400,
                'cats' => ['best-selling', 'coin-hobby', 'gift-showpiece'],
                'img' => 'https://images.unsplash.com/photo-1610375461246-83df859d849d?w=800&q=80',
                'best' => true, 'featured' => true,
                'desc' => 'Assorted replica world coins with red velvet pouch.',
            ],
            [
                'name' => 'Gold 20 Dollar Saint-Gaudens Double Eagle replica coin',
                'price' => 999, 'compare' => 2200,
                'cats' => ['best-selling', 'coin-hobby'],
                'img' => 'https://images.unsplash.com/photo-1610375461369-d613b5647406?w=800&q=80',
                'best' => true,
                'desc' => 'Copper replica of Saint-Gaudens Double Eagle design. Diameter 34mm.',
            ],
            [
                'name' => 'Alexander the Great Stater, Greek gold Coin replica',
                'price' => 799, 'compare' => 2000,
                'cats' => ['coin-hobby'],
                'img' => 'https://images.unsplash.com/photo-1621415814107-6f1d0c0c0c0c?w=800&q=80',
                'desc' => 'Modern replica of Macedonian stater style coin.',
            ],
            [
                'name' => 'Arabic Coin, Ottoman Sultani Gold Coin replica',
                'price' => 599, 'compare' => 1400,
                'cats' => ['coin-hobby'],
                'img' => 'https://images.unsplash.com/photo-1589744097922-6c0c0c0c0c0c?w=800&q=80',
                'desc' => 'Gold plated alloy replica with tughra-inspired design.',
            ],
            [
                'name' => 'Athenian Owl Tetradrachm Coin, Greek Coin replica',
                'price' => 599, 'compare' => 1400,
                'cats' => ['coin-hobby'],
                'img' => 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=800&q=80',
                'desc' => 'Silver-look replica of the classic Athenian owl tetradrachm.',
            ],
            [
                'name' => 'EKATEPNHA Rome 1762 Denarius replica coin',
                'price' => 799, 'compare' => 1400,
                'cats' => ['best-selling', 'coin-hobby'],
                'img' => 'https://images.unsplash.com/photo-1634704784915-d9d3c0c0c0c0?w=800&q=80',
                'best' => true,
                'desc' => 'Silver alloy replica denarius style coin.',
            ],
            [
                'name' => 'Ethiopian Lion, Menelik II Three Dollar Coin replica',
                'price' => 799, 'compare' => 1400,
                'cats' => ['coin-hobby'],
                'img' => 'https://images.unsplash.com/photo-1610375461246-83df859d849d?w=800&q=80',
                'desc' => 'Silver alloy replica featuring Lion of Judah inspired design.',
            ],
            [
                'name' => 'Natural Pink color crystal stone for Jewelry, gift and showpiece',
                'price' => 499, 'compare' => 999,
                'cats' => ['jewelary-stones', 'gift-showpiece'],
                'img' => 'https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?w=800&q=80',
                'desc' => 'Pink crystal stone for jewelry making and decoration.',
            ],
            [
                'name' => 'Mini breadboard. SYB 170 hole breadboard with buckle',
                'price' => 129, 'compare' => 250,
                'cats' => ['diy-project', 'electronics-gadgets'],
                'img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&q=80',
                'desc' => 'Mini colorful 170 hole breadboard for DIY electronics.',
            ],
        ];

        foreach ($products as $row) {
            $product = Product::updateOrCreate(
                ['slug' => Str::slug($row['name'])],
                [
                    'name' => $row['name'],
                    'sku' => 'CG-'.strtoupper(Str::random(6)),
                    'short_description' => Str::limit($row['desc'], 140),
                    'description' => $row['desc'],
                    'price' => $row['price'],
                    'compare_price' => $row['compare'],
                    'image' => $row['img'],
                    'gallery' => [$row['img']],
                    'colors' => $row['colors'] ?? null,
                    'stock' => 80,
                    'is_featured' => $row['featured'] ?? false,
                    'is_bestseller' => $row['best'] ?? false,
                    'is_new' => $row['new'] ?? false,
                    'rating' => fake()->randomFloat(1, 4.4, 5.0),
                    'reviews_count' => fake()->numberBetween(8, 86),
                ]
            );

            $ids = collect($row['cats'])->map(fn ($slug) => $catModels[$slug]->id)->all();
            $product->categories()->sync($ids);
        }
    }
}
