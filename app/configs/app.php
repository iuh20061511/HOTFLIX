<?php
function timKhoangThoiGianKhaDung($lichPhim, $thoiLuongPhimMoi, $gioLamViecBatDau = 8, $gioLamViecKetThuc = 24)
{
    $khoangThoiGianKhaDung = [];

    // Kiểm tra nếu không có lịch phim nào thì tạo khoảng trống từ giờ làm việc bắt đầu đến kết thúc
    if (empty($lichPhim)) {
        for ($gio = $gioLamViecBatDau; $gio + $thoiLuongPhimMoi <= $gioLamViecKetThuc; $gio += $thoiLuongPhimMoi) {
            $khoangThoiGianKhaDung[] = [$gio, $gio + $thoiLuongPhimMoi];
        }
        return $khoangThoiGianKhaDung;
    }

    // Sắp xếp lịch phim theo thời gian bắt đầu để dễ dàng xác định khoảng trống
    usort($lichPhim, function ($a, $b) {
        return $a['batDau'] - $b['batDau'];
    });

    // Kiểm tra khoảng trống trước bộ phim đầu tiên
    if ($lichPhim[0]['batDau'] > $gioLamViecBatDau) {
        for ($gio = $gioLamViecBatDau; $gio + $thoiLuongPhimMoi <= $lichPhim[0]['batDau']; $gio += $thoiLuongPhimMoi) {
            $khoangThoiGianKhaDung[] = [$gio, $gio + $thoiLuongPhimMoi];
        }
    }

    // Kiểm tra khoảng trống giữa các bộ phim
    for ($i = 0; $i < count($lichPhim) - 1; $i++) {
        $ketThucPhimHienTai = $lichPhim[$i]['ketThuc'];
        $batDauPhimKeTiep = $lichPhim[$i + 1]['batDau'];

        // Nếu có khoảng trống giữa kết thúc phim hiện tại và bắt đầu phim kế tiếp
        if ($batDauPhimKeTiep > $ketThucPhimHienTai) {
            for ($gio = $ketThucPhimHienTai; $gio + $thoiLuongPhimMoi <= $batDauPhimKeTiep; $gio += $thoiLuongPhimMoi) {
                $khoangThoiGianKhaDung[] = [$gio, $gio + $thoiLuongPhimMoi];
            }
        }
    }

    // Kiểm tra khoảng trống sau bộ phim cuối cùng
    $ketThucPhimCuoi = end($lichPhim)['ketThuc'];
    if ($ketThucPhimCuoi < $gioLamViecKetThuc) {
        for ($gio = $ketThucPhimCuoi; $gio + $thoiLuongPhimMoi <= $gioLamViecKetThuc; $gio += $thoiLuongPhimMoi) {
            $khoangThoiGianKhaDung[] = [$gio, $gio + $thoiLuongPhimMoi];
        }
    }

    return $khoangThoiGianKhaDung;
}

// Ví dụ sử dụng
$lichPhim = [
    ['batDau' => 8, 'ketThuc' => 10],  // Phim 1: 8h - 10h
    ['batDau' => 14, 'ketThuc' => 17], // Phim 2: 14h - 17h
    ['batDau' => 21, 'ketThuc' => 22]  // Phim 3: 21h - 22h
];

$thoiLuongPhimMoi = 1.5; // Bộ phim mới có thời lượng 3 giờ

$khoangThoiGian = timKhoangThoiGianKhaDung($lichPhim, $thoiLuongPhimMoi);

// In kết quả
foreach ($khoangThoiGian as $khoang) {
    echo "Khoảng thời gian khả dụng: {$khoang[0]}h - {$khoang[1]}h" . "<br>";
}
?>