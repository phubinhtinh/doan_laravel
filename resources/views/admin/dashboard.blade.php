@extends('admin.layouts.app')

@section('title', 'Tổng quan | Admin ATELIER')
@section('page-title', 'Bảng Phân Tích Dữ Liệu')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h2>Hiệu Suất Sản Phẩm</h2>
            <div class="admin-card-id" style="margin-top: 4px;">Theo dõi doanh thu, số lượng bán và xu hướng trong 30 ngày qua.</div>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <span class="admin-badge" style="background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; gap: 4px;">
                <span class="material-symbols-outlined" style="font-size: 14px;">trending_up</span>
                Trực tiếp
            </span>
        </div>
    </div>
    
    <div class="admin-table-wrapper" style="max-height: 70vh;">
        <table class="admin-table">
            <thead style="position: sticky; top: 0; z-index: 10; background: #16171f; box-shadow: 0 1px 0 rgba(255,255,255,0.06);">
                <tr>
                    <th style="background: #16171f;">Sản Phẩm</th>
                    <th style="background: #16171f; text-align: right;">Doanh Thu (30 Ngày)</th>
                    <th style="background: #16171f; text-align: right;">Số Lượng Bán</th>
                    <th style="background: #16171f; text-align: center; width: 140px;">Xu Hướng</th>
                    <th style="background: #16171f; text-align: right;">Tồn Kho</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div class="admin-table-img" style="display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.04);">
                                <span class="material-symbols-outlined" style="color: #71717a;">apparel</span>
                            </div>
                            <div>
                                <div class="admin-product-name">{{ $product['name'] }}</div>
                                <div class="admin-product-slug">PRD-{{ sprintf('%04d', $loop->iteration) }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: right;">
                        <span class="admin-price" style="color: #818cf8;">{{ $product['revenue_30d'] > 0 ? number_format($product['revenue_30d'], 0, ',', '.') . ' ₫' : '-' }}</span>
                    </td>
                    <td style="text-align: right;">
                        <span style="font-weight: 500; color: #e4e4e7;">{{ $product['quantity_30d'] > 0 ? $product['quantity_30d'] : '0' }}</span>
                    </td>
                    <td style="text-align: center;">
                        <div style="height: 35px; width: 100px; margin: 0 auto; display: flex; align-items: flex-end;">
                            <canvas class="sparkline-canvas" width="100" height="35" data-trend="{{ json_encode($product['trend_data']) }}"></canvas>
                        </div>
                    </td>
                    <td style="text-align: right;">
                        @if($product['stock'] > 20)
                            <span class="admin-badge" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                                Tốt ({{ $product['stock'] }})
                            </span>
                        @elseif($product['stock'] > 0)
                            <span class="admin-badge" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                                Thấp ({{ $product['stock'] }})
                            </span>
                        @else
                            <span class="admin-badge" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                                Hết hàng
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="admin-table-empty">
                        <span class="material-symbols-outlined" style="font-size: 32px; opacity: 0.5;">inbox</span>
                        <p>Chưa có dữ liệu sản phẩm hoặc đơn hàng.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const canvases = document.querySelectorAll('.sparkline-canvas');
        
        canvases.forEach(canvas => {
            const trendData = JSON.parse(canvas.getAttribute('data-trend'));
            
            // Determine trend color (compare second half of the month to first half)
            let color = 'rgba(156, 163, 175, 1)'; // Gray
            let bgColor = 'rgba(156, 163, 175, 0.2)';

            const total = trendData.reduce((a, b) => a + b, 0);
            if (total > 0) {
                const firstHalf = trendData.slice(0, 15).reduce((a, b) => a + b, 0);
                const secondHalf = trendData.slice(15, 30).reduce((a, b) => a + b, 0);
                
                if (secondHalf > firstHalf) {
                    color = 'rgba(34, 197, 94, 1)'; // Green (Tăng trưởng)
                    bgColor = 'rgba(34, 197, 94, 0.3)';
                } else if (secondHalf < firstHalf) {
                    color = 'rgba(239, 68, 68, 1)'; // Red (Giảm sút)
                    bgColor = 'rgba(239, 68, 68, 0.3)';
                }
            }

            // If flat line with data, keep it gray or slight blue. We'll use gray as default.

            new Chart(canvas, {
                type: 'line',
                data: {
                    labels: Array.from({length: 30}, (_, i) => i + 1),
                    datasets: [{
                        data: trendData,
                        borderColor: color,
                        backgroundColor: bgColor,
                        borderWidth: 2,
                        fill: true,
                        pointRadius: 0,
                        pointHoverRadius: 0,
                        tension: 0.1 // Slight curve
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                    animation: false,
                    layout: {
                        padding: 0
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    },
                    scales: {
                        x: { display: false },
                        y: { display: false, min: 0 }
                    }
                }
            });
        });
    });
</script>
@endsection
