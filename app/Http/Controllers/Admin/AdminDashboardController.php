<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $thirtyDaysAgo = now()->subDays(30);

        // Lấy tất cả sản phẩm cùng với orderItems trong 30 ngày qua
        $productsQuery = Product::with(['orderItems' => function ($query) use ($thirtyDaysAgo) {
            $query->where('created_at', '>=', $thirtyDaysAgo);
        }])->get();

        $products = [];

        foreach ($productsQuery as $product) {
            $revenue30d = 0;
            $quantity30d = 0;
            $trend = array_fill(0, 30, 0); // Khởi tạo mảng 30 ngày với giá trị 0

            foreach ($product->orderItems as $item) {
                $revenue30d += $item->price * $item->quantity;
                $quantity30d += $item->quantity;

                // Tính toán vị trí (index) của ngày: 0 là 29 ngày trước, 29 là hôm nay
                $dayDiff = $item->created_at->startOfDay()->diffInDays(now()->startOfDay());
                $dayIndex = 29 - $dayDiff;
                
                if ($dayIndex >= 0 && $dayIndex < 30) {
                    $trend[$dayIndex] += $item->quantity;
                }
            }

            $products[] = [
                'name' => $product->name,
                'revenue_30d' => $revenue30d,
                'quantity_30d' => $quantity30d,
                'stock' => $product->stock,
                'trend_data' => $trend,
            ];
        }

        // Sắp xếp theo số lượng bán giảm dần
        usort($products, function ($a, $b) {
            return $b['quantity_30d'] <=> $a['quantity_30d'];
        });

        return view('admin.dashboard', compact('products'));
    }
}
