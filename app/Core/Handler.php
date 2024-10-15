<?php
class Handler
{
    function roundCustom($number)
    {

        if (floor($number) == $number) {
            return $number;
        }

        $integerPart = floor($number);
        $fraction = $number - $integerPart;

        if ($fraction < 0.5) {
            return $integerPart + 0.5;
        } elseif ($fraction > 0.5) {
            return ceil($number);
        } else {
            return $number;
        }
    }

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

    function convertToTime($input)
    {
        $parts = explode('_', $input);

        $hour = (int)$parts[0];
        $minute = 0;
        if (isset($parts[1])) {
            $minute = (int)$parts[1] * 6;
        }

        return sprintf('%02d:%02d:00', $hour, $minute);
    }

    function splitInput($input)
    {

        $parts = explode(',', $input);
        $result = [];

        foreach ($parts as $part) {
            $result[] = trim($part);
        }

        return $result;
    }

    function generateRandomColor()
    {
        do {
            $randomColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        } while ($randomColor === '#000000');

        return $randomColor;
    }
}
