-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 12, 2025 lúc 02:56 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanly`
--
CREATE DATABASE IF NOT EXISTS `quanly` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `quanly`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_bill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `total_bill`) VALUES
(2, 7, 3, 2, 3100000),
(3, 8, 6, 1, 1000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doanhthu`
--

CREATE TABLE `doanhthu` (
  `id` int(11) NOT NULL,
  `totall` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `doanhthu`
--

INSERT INTO `doanhthu` (`id`, `totall`) VALUES
(1, 12390000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total_bill` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `fullname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`fullname`, `address`, `email`, `number`, `username`, `password`, `id`) VALUES
('Quang Huy', 'Hà Nội', 'qhuy180105@gmail.com', '0832017578', 'qhuy180105', '202cb962ac59075b964b07152d234b70', 4),
('Khánh', 'Việt Nam', 'nqhuy180105@gmail.com', '0995566415', 'user1', 'e10adc3949ba59abbe56e057f20f883e', 6),
('khanh', '2', 'kit731048@gmail.com', '0945088056', '123', '202cb962ac59075b964b07152d234b70', 7),
('tuan', '2', 'khanh350505@gmail.com', '0945088056', '23', '37693cfc748049e45d87b8c7d8b9aacd', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `info` varchar(1000) NOT NULL,
  `img_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `name`, `price`, `type`, `quantity`, `img`, `info`, `img_info`) VALUES
(1, 'CRISIS CORE FINAL FANTASY VII REUNION', 1200000, 0, 30, 'images/6c05bddcc3ba48c19de3e054fec8334c_c6255738a81d46ef99831d19d33040d7_master.webp', 'Crisis Core Final Fantasy VII Reunion cho PS5 có bán tại nShop sẽ lần nữa kể lại câu chuyện của Zack Fair khi làm nhiệm vụ truy tìm Genesis Rhapsodos, kéo theo những điều bất ngờ, tiết lộ hàng loạt bí mật liên quan đến tập đoàn Shinra. Đây chính là phần tiền truyện của Final Fantasy VII!\r\n   Hệ thống chiến đấu trong Crisis Core đi theo hướng hành động thời gian thực. Bạn có thể điều khiển Zack di chuyển xung quanh, tấn công cơ bản (chặt chém), dùng kỹ năng đặc biệt và phép thuật, dùng item, né hoặc chặn các đòn đánh của đối thủ rất thuận tiện nhờ việc bố trí nút bấm hợp lý.', 'images/shop_game_ban_crisis_core_final_fantasy_vii_reunion_gia_re_nhat_4c93cd85a62141d2aa354c3500504647.jpg'),
(2, 'Demon\'s Souls', 1350000, 5, 5, 'images/demons_souls_ps5_ceab927a60a3440b8fe9a9ce48dc2caf_master.webp', 'Game Demon\'s Souls cho PS5 đang bán tại nShop là phiên bản làm lại hoàn toàn của siêu phẩm cùng tên năm xưa trên PS3, cũng chính là tựa game khởi đầu cho thể loại siêu khó, chuyên \"hành hạ\" người chơi.\r\n\r\nDemon\'s Souls PS5 không chỉ đẹp lộng lẫy, lột tả không khí nguy hiểm rợn người của thế giới trong đó, mà còn được cải tiến lại gameplay, nâng tầm trải nghiệm qua những tính năng mới chẳng hạn như \"rung phản hồi\" của tay cầm DualSense. Mỗi nhát chém trong game của bạn đều có cảm giác chân thực hơn hẳn.', 'images/cach_choi_game_demons_souls_ps5_2c9f51227c4a4c088661762bdd6db664_grande.webp'),
(3, 'Gundam Breaker 4', 1550000, 5, 0, 'images/gundam_breaker_4_ps5_362a5af4475e403a881b540bd8f79dc1_master.webp', 'Series game với khả năng tùy biến gunpla cực lớn đã trở lại với Gundam Breaker 4 cho PS5 có bán ở nShop. Trong vai một fan gunpla cuồng nhiệt, người chơi sẽ phối hợp nhiều bộ phận khác nhau để tạo ra mô hình mecha riêng của mình trong Gundam Breaker 4. Có tới hơn 250 mobile suit nổi tiếng từ nhiều series Gundam khác nhau tụ hợp trong trò chơi cho bạn tùy biến, sáng tạo vô tận.\r\nĐiểm hấp dẫn của loạt game Gundam Breaker còn nằm ở chỗ người chơi có thể đem sáng tạo của mình tham gia vào các trận chiến ảo. Nhiều nhiệm vụ và chiến trường độc đáo, cho bạn chém giết, bắn tan quân địch, tìm kiếm các bộ phận mới để tiếp tục tùy biến mobile suit của mình xa hơn. Tối đa ba người có thể chơi co-op với nhau cùng lúc.', 'images/review_game_gundam_breaker_4_ps4_ps5_swicth_hay_nhat.webp'),
(4, 'Minecraft', 1080000, 5, 0, 'images/h_cho_may_ps5_do_hoa_doc_dao_game_sinh_ton_sang_tao_hay_nhat_dang_choi_2eac2d2f6b6c459a997ac3626603bff6_master.webp', 'Minecraft – tựa game huyền thoại thu hút triệu người chơi đã chính thức ra mắt trên PlayStation 5 với phiên bản tối ưu độc quyền. Minecraft cho PS5 đang bán tại nShop tận dụng tối đa sức mạnh của PS5, cho phép bạn chơi game ở độ phân giải 4K với tốc độ khung hình 60 FPS. Khoảng cách dựng khung hình (Render Distance) xa hơn giúp bạn phát hiện tài nguyên dễ dàng hơn và chuẩn bị tốt hơn trong cuộc phiêu lưu sinh tồn.', 'images/t_cho_ps5_tro_choi_the_gioi_mo_sandbox_hap_dan_cho_nguoi_lon_va_tre_em.webp'),
(5, 'It Take Two', 900000, 4, 0, 'images/it_takes_two_ps4_38c5cb5de360488992de856604558033_master.webp', 'It Takes Two có bán tại nShop - Tựa game đoạt giải Game of The Year 2021 và được đánh giá là game Co-op hay nhất mọi thời đại đã có mặt trên PS4! Đúng như tên game, bạn sẽ phải tìm cho mình một người bạn đồng hành vì đây là game co-op thuần, không hề hỗ trợ chế độ chơi đơn! \r\n\r\nNhưng đừng lo, game có kèm theo Friend\'s Pass để bạn có thể mời bạn vào chơi cùng hoàn toàn miễn phí, chính vì vậy nên bạn không cần lo lắng phải mua 2 bản game, việc của bạn chỉ đơn giản là tìm người chơi cùng mà thôi!', 'images/review_game_it_takes_two_ps4_f2e4174aed3d4533a560d6ea326c25fc_grande.webp'),
(6, 'Onepiece', 1000000, 4, 0, 'images/one_piece_pirate_warriors_4_ps4_b605f347a21b4448809ff4678f3d5134_master.webp', 'Loạt game Pirate Warriors đã trở lại và mang theo mình một câu chuyện mới đầy bùng nổ, nhiều môi trường hơn và thậm chí những đòn đánh cũng điên cuồng hơn trong One Piece: Pirate Warriors 4. Hãy theo chọn Luffy cùng băng Mũ Rơm từ lúc họ khởi hành qua các đảo khác nhau, ra đi với hy vọng tìm được kho báu huyền thoại - One Piece. Bạn sẽ được trải nghiệm một số khu vực tuyệt đỉnh nhất trong câu chuyện của One Piece.', 'images/mua_game_one_piece_pirate_warriors_4_nintendo_switch_ps4_gia_re_2b9eb3a2cf59403186629224439f5748_grande.webp'),
(7, 'Like a Dragon Ishin', 1280000, 5, 0, 'images/a4d8918b1eda4ec9b4cac68400ca7047_5c1e305e83ca46eda9de486a5defce32_master.webp', 'Là bản game mới được mong đợi nhất của Ryu Ga Gotoku Studio, Like a Dragon Ishin cho PS5 có bán tại nShop sẽ đưa bạn trở lại thành phố Kyo năm 1860 đầy loạn lạc, theo bước chân Sakamoto Ryoma trên con đường đi tìm công lý. Sự kết hợp độc đáo của đa dạng cách chiến đấu cùng với lối dẫn chuyện nổi tiếng của Studio làm nên series Yakuza lừng lẫy, chắc chắn sẽ không khiến bạn thất vọng! ', 'images/game_giong_yakuza_like_a_dragon_ishin_a52d44bda7644c1ebb07bbab0e055fb5.jpg'),
(8, 'FIFA 25 - EA Sports FC 25', 1650000, 5, -1, 'images/ea_sports_fc_25_cho_may_ps5_game_da_banh_sieu_chan_thuc_do_hoa_dep_mat_bc560546aaed465b99f6751890cd4de0_master.webp', 'Fan hâm mộ của môn thể thao vua, đam mê những khoảnh khắc kịch tính trên sân cỏ, nhất định không thể bỏ qua FIFA 25 - EA Sports FC 25 cho PS5 đang bán tại nShop. Tựa game này mang đến trải nghiệm đỉnh cao với nhiều chế độ chơi mới lạ và hấp dẫn. Đi cùng với đó là kho nội dung khổng lồ về cầu thủ, câu lạc bộ, giải đấu trên toàn thế giới. Hãy sẵn sàng đắm mình vào những trận đấu sống động và đưa đội bóng của bạn lên đỉnh cao.', 'images/5_game_da_banh_the_thao_giai_tri_thu_vi_mang_den_trai_nghiem_tuyet_voi.jpg'),
(9, 'GRAND THEFT AUTO V - GTA 5', 750000, 4, 20, 'images/ps4-xbox-one-gta-5-release-800x800_master.webp', 'Rockstar Games vừa tung đoạn trailer của Grand Theft Auto V (GTA V) cho hệ máy Xbox One và PlayStation 4, chỉ tám ngày trước khi phiên bản này được phát hành vào này 18/11 tới đây. Đoạn trailer này sẽ sớm xuất hiện trên các kênh truyền hình để thu hút sự chú ý của game thủ.\r\nTới nay, GTA V đã bán được hơn 34 triệu bản cho Xbox 360 và PlayStation 3, đồng thời trở thành game bán chạy nhất trong năm 2013. Nhà phát hành Take-Two cho rằng game vẫn còn rất nhiều tiềm năng bán hàng với hai hệ máy đời cũ này. Những game thủ đã mua GTA V trên Xbox 360 hoặc PS3 và nâng cấp lên phiên bản next-gen sẽ được nhận vô số lợi ích trong game như vũ khí và phương tiện di chuyển mới. Ngoài ra, Rockstar đã xác nhận phiên bản cho Xbox One, PS4 và PC sẽ có chế độ bắn súng góc nhìn thứ nhất.', 'images/grand_theft_auto_v_nshop_grande.webp'),
(10, 'RESIDENT EVIL 5', 590000, 4, 20, 'images/resident-evil-5-ps4-1-800x800_master.webp\r\n', 'Những hiểm họa sinh học vẫn chưa kết thúc. Chỉ vừa khi mối nguy của Resident Evil bị phá hủy, thì lại có một nỗi sợ mới khiến người chơi phải rùng mình. Người hùng Chris Redfield đã và đang theo dấu \"ác quỷ\" vòng quanh thế giới theo đúng nghĩa đen. Sau khi gia nhập tổ chức mới, Chris đến Châu Phi, nơi vừa bị khủng bố sinh học biến con người và động vật trong những thành phố đông đúc trở thành các sinh vật điên loạn, không kiểm soát. Chris phải nhận thử thách tìm ra sự thật đằng sau kế hoạt ma quỷ này.', 'images/resident_evil_5_shop_grande.jpg'),
(11, 'GOD OF WAR III REMASTERED', 590000, 4, 20, 'images/god-of-war-iii-remastered-ps4_master.jpg', 'Phần 3 của thiên anh hùng ca về chiến thần Kratos sẽ cập bến PS4 dưới dạng Remastered, với độ phân giải Full HD, cơ chế combat mượt như lụa, và hàng loạt các cải thiện nhắm vào các fan trung thành của dòng game, tất cả để chào mừng kỷ niệm 10 năm kể từ ngày Kratos bắt đầu cuộc hành trình của mình.\r\n \r\nCốt truyện của game vẫn vậy, chúng ta sẽ được đắm mình trong thế giới thần thoại hy lạp cổ, God Of War 3 đóng vai trò là chương cuối cùng của cuộc đời đầy thăng trầm của Kratos khi anh muốn báo thù các vị thần trên đỉnh Olympus những kẻ mà đã phản bội anh. Để đạt được mục đích của mình anh phải dấn thân xuống những góc tối tăm nhất của địa ngục chiến đấu với các con quái vật, các vị thần, cũng như các anh hùng huyền thoại, giải những câu đố hóc búa tất cả chỉ phục vụ cho một mục tiêu duy nhất hủy diệt đỉnh Olympus.', 'images/god_of_war_iii_remastered_grande.jpg'),
(12, 'Diablo IV ', 1450000, 4, 20, 'images/diablo_iv_ps4_0a898bbf28004d9c80f0dd8cf1f66600_master.webp', 'Diablo IV bán ở nShop tiếp tục đưa tên tuổi thương hiệu game nhập vai Diablo nổi tiếng lên một tầm cao mới. Trò chơi đã tạo ra hàng loạt kỷ lục mới với hàng triệu game thủ khắp thế giới. Những tính năng hấp dẫn, thử thách đáng gờm đang chờ bạn trong tựa game bom tấn này.\r\nTrong Diablo IV, bạn sẽ tiếp tục cuộc chiến lớn của mình trong hành trình giải cứu thế giới Sanctuary đen tối khỏi Blessed Mother Lilith. Bạn sẽ phải chiến đấu với hàng bầy quỷ quái cùng các con quái vật ngáng đường.\r\n\r\n', 'images/cach_choi_game_diablo_iv_ps4_ps5_2f2edd35e4214ed2a41ee56ae967d851_grande.jpg'),
(13, 'MINECRAFT PLAYSTATION 4 EDITION', 990000, 4, 20, 'images/minecraftps4-800x800_master.webp', 'Là một tựa game với nét đồ họa cực kỳ độc đáo - tôi dùng từ độc đáo chứ không phải là xấu, cùng lối chơi đậm chất hardcore gamer, Minecraft khá kén người chơi. Nói là kén không phải là vì nó khó, game quả thật không dễ, nhưng nó sẽ làm nản chí những người chơi mới do ... không biết phải làm gì trong game. Hãy cứ thong thả chơi, vừa chơi vừa ngắm cảnh quan thật đẹp. Những người trụ tới cuối cùng sẽ cảm nhận được hết cái hay của một game thế giới siêu mở như Mnecraft.\r\n\r\nNgười viết đến với Minecraft một cách rất tình cờ, đó là từ một mẩu tin nho nhỏ trên blog của đội ngũ làm Team Fortress 2 chia sẻ rằng cả nhóm đã bị sao lãng chỉ vì quá nghiện một tựa game độc lập (indie) mang tên Minecraft. Tò mò về sức hút kì lạ này, người viết quyết định đào sâu tới thế giới của Minecraft.\r\n\r\nMinecraft được phát triển độc lập bởi một lập trình viên có nickname Notch. Tính đến thời điểm hiện tại, Minecraft đang được chia ra làm hai phiên bản, một là Minecraft Classic, và Minecraft Alpha. Trong bài viết', 'images/minecraft_playstation_4_edition_shop_vietnam_grande.webp'),
(14, 'Dragon Ball FighterZ', 750000, 4, 20, 'images/ps4259_-_dragon_ball_fighterz_ps5_ps4_5d9a8af2848c48faac2cfbc6d412bcfb_master.webp\r\n\r\n', 'Dragon Ball là một thương hiệu cực kỳ đắt hàng ở nhiều lĩnh vực, cả trong mảng game cũng vậy, các phiên bản trò chơi mới cứ liên tục được tung ra, không có dấu hiệu chậm lại. Phần mới nhất hiện nay là Dragon Ball FighterZ được phát hành máy PS4 PS5. Trò chơi thuộc dạng song đấu 2.5D, do Arc System Works phát triển, và Bandai Namco phát hành.\r\nDragon Ball FighterZ sử dụng hệ thống chiến đấu kiểu 3-chọi-3, cho phép người chơi xác định độ tương hợp giữa các nhân vật và xây dựng một team riêng cho mình. Nó cũng sẽ mang lại các trận đánh tốc độc cực cao, và những đòn tuyệt kỹ rực rỡ, hai thứ mà series Dragon Ball rất nổi tiếng.', 'images/dragon_ball_fighterz_nshop_grande.jpg'),
(15, 'RESIDENT EVIL 6', 690000, 4, 20, 'images/resident-evil-6-ps4-800x800_master.webp', 'Hòa trộn phong cách hành động cùng kinh dị, Resident Evil 6 đã mang lại những trải nghiệm đầy kịch tính cho game thủ từ năm 2012. Giờ đây, tựa game này được làm mới trên hệ máy chơi game hiện đại PlayStation 4 và sẵn sàng cho bạn sống lại những giây phút đấu tranh căng thẳng ấy.\r\nHai nhân vật được yêu thích của series Resident Evil là Leon S. Kennedy và Chris Redfield cùng các nhân vật mới, bao gồm cả Jake Muller, đối mặt với mối họa khủng bố sinh học mang quy mô thế giới. Cuộc chiến đấu trải dài qua nhiều khu vực từ Bắc Mỹ, đến Edonia và cả Trung Quốc.', 'images/resident_evil_6_vietnam_grande.jpg'),
(16, 'WORLD OF FINAL FANTASY', 990000, 4, 20, 'images/wff_master.jpg', 'World of Final Fantasy kết hợp các cơ chế nhập vai truyền thống (như đánh theo lượt) với lối tạo hình kiểu \"đồ chơi\". Bạn sẽ dẫn dắt một cặp song sinh tên Reynn và Lann đi qua vùng đất Grymoire để tìm kiếm lại những ký ức thất lạc của mình. Qua cuộc du hành này, người chơi sẽ thu thập, nuôi dưỡng và chiến đấu cùng những sinh vật đáng yêu từng xuất hiện trong series Final Fantasy như cactuar, chocobo, behemoth... Ngoài ra còn có nhiều nhân vật trong các phần game Final Fantasy trước đây xuất hiện.', 'images/world_of_final_fantasy_nshop_grande.jpg'),
(17, 'Overcooked! All You Can Eat cho PS4', 850000, 4, 20, 'images/overcooked_all_you_can_eat_ps4_01448cad969248a18e8b7e8246dcb950_master.webp', '', ''),
(18, 'WITCHER 3: WILD HUNT COMPLETE EDITION', 850000, 4, 20, 'images/ps4076_-_witcher_3_wild_hunt_complete_edition_ps5_ps4_78f7235867224e58a175adbfc204ef7b_master.webp', '', ''),
(19, 'Need for Speed Heat cho PS4 PS5', 890000, 4, 20, 'images/need_for_speed_heat_cho_ps4_6832aaee70ff4a60ac340e0c44976420_master.webp', '', ''),
(20, 'Street Fighter 6', 1350000, 4, 20, 'images/81432f90cd50431c8d050d0349cda3ed_9a935a3caddc4cb59adcd29b45452f19_master.webp', '', ''),
(21, 'Rise of the Ronin', 1799000, 5, 20, 'images/rise_of_the_ronin_cho_ps5_6cdb35d4a8e842e2824baad837cbf3af_master.webp', '', ''),
(22, 'God of War Ragnarok ', 1799000, 5, 20, 'images/fa52fe3e6b5445819c3511681243eecd_95726761cf4b4ec4ab241e0582a46172_master.jpg', '', ''),
(23, 'Assassin\'s Creed Mirage', 1250000, 5, 20, 'images/assassin_s_creed_mirage_ps5_92a1e470602b4378aa2221db63917109_master.webp', '', ''),
(24, 'Spider Man Miles Morales', 1280000, 5, 20, 'images/396dc5e563d44bfc8c84f539e588b1bb_80173703822844f5be64b8be5fd26b3e_master.webp', '', ''),
(25, 'Mortal Kombat 1 ', 1400000, 5, 20, 'images/mortal_kombat_1_cho_ps5_41cda9d601f449a3889e3e4331fed357_master.webp', '', ''),
(26, 'Persona 5 Tactica', 1250000, 5, 20, 'images/persona_5_tactica_ps5_16cb9d223e994161b367bf034e531180_master.webp', '', ''),
(27, 'Prince of Persia The Lost Crown', 1350000, 5, 20, 'images/7a628cdc46414ce4b1ce6786ddfed933_2f63b8fabbdd4caa8fcb0fd4cb1f629d_master.webp', '', ''),
(28, ' Persona 5 Royal', 1200000, 5, 20, 'images/37527dd3972346fb8d1bd34f1af42822_4ae79bb56e834dac8145f03a5e96cf0c_master.webp', '', ''),
(29, 'Wo Long Fallen Dynasty', 1350000, 5, 20, 'images/wo_long_fallen_dynasty_ps5_4688c2808e4848e685af2ee36283f111_master.webp', '', ''),
(30, 'Gotham Knights', 1300000, 5, 20, 'images/e8d1d96d582a43549e1dbae1571cb98a_b944c27a8fa94256bf842b16dbdbf697_master.webp', '', ''),
(31, 'Dead Space', 1600000, 5, 20, 'images/3ce7215eaef744238f63518c9aa83e6a_e3390f5d0e7f4a038b20e5f0cc86c10e_master.webp', '', ''),
(32, 'Scarlet Nexus', 990000, 5, 20, 'images/scarlet_nexus_ps5_55ddd88840ae474a95fbc04a8990da8c_master.webp', '', ''),
(33, 'Astro Bot - PS5', 1195000, 5, 0, 'images/astro-bot---ps5-P1763-1726005427186.jpg', 'Astro Bot cho PS5 đang bán tại nShop là một tựa game Platformer xuất sắc của Sony. Trò chơi cuốn game thủ vào những thiết kế rất sáng tạo và nhịp độ rất hút, ứng dụng tốt các điểm mạnh của tay cầm PlayStation 5. Đừng bỏ qua trò chơi giải trí rất thư giãn mà cũng đầy thử thách này. Game phù hợp cho mọi lứa tuổi.', 'images/gameplay_astro_bot_ps5_moi_nhat_grande.jpg'),
(34, 'Persona 3 Reload', 1350000, 5, 20, 'images/075_persona_3_reload_cho_ps5_2fbab57b9a3f40078d99c5d6cc5bf02c_master.webp', 'Game Persona 3 Reload cho PS5 có bán tại nShop là phiên bản làm lại của một trong những game nhập vai được yêu thích nhất mọi thời đại - Persona 3 lừng danh! Trong lần trở lại này, bạn sẽ được diện kiến một P3 đẹp mắt hơn, sống động hơn với phần lồng tiếng tiếng Anh hoàn toàn mới, chắc chắn sẽ thỏa mãn được cả fan cũ lẫn người chơi mới!', 'images/mua_game_nhap_vai_hay_nhat_persona_3_reload_cho_playstation_5_e54258d29d964ce99f84e8bb1254faaf.jpg'),
(35, 'Black Myth: Wukong Delux Edition', 1580000, 5, 0, 'images/dia-game-myth-wukong---ps5-P859-1734568252866.jpg', 'Black Myth Wukong Deluxe Edition cho PS5 đang bán tại nShop là một game nhập vai hành động lấy cảm hứng từ thần thoại Trung Quốc. Câu chuyện dựa trên Tây Du Ký, một trong Tứ Đại Danh Tác của văn học Trung Hoa. Bạn sẽ vào vai Thiên Mệnh Nhân để dấn thân vào những thử thách và điều kỳ diệu phía trước, để khám phá ra sự thật ẩn giấu bên dưới bức màn của một truyền thuyết huy hoàng từ quá khứ.\r\n\r\nOne Piece Odyssey: Deluxe Edition bao gồm toàn bộ game chính, kèm theo vũ khí độc quyền, trang bị, bảo vật (có thể nhận được từ menu Trailblazer\'s Gift tại Keeper\'s Shrine (Điểm Hồi Sinh) ở giai đoạn đầu trò chơi), cùng với Thư viện nhạc nền kỹ thuật số chọn lọc.', 'images/black_myth_wukong_deluxe_ps5_-_game_hot_khong_the_bo_lo_cho_fan_ps5_.webp'),
(36, 'SIFU Vengeance Edition', 1050000, 5, 20, 'images/sifu_vengeance_edition_ps5_42e10a02a4454a438137a001fe1dc10c_master.webp', 'Sifu sẽ đưa bạn đến với câu chuyện của một cậu trai trẻ đang trên đường phục thù cho gia đình đã bị sát hại của mình. Anh ta không có bất kì ai là đồng minh nhưng lại có vô số kẻ thù đang chờ đợi. Thứ duy nhất mà anh ta có thể dựa vào chính là kĩ thuật Kung Fu độc đáo cùng chuỗi đồng xu bí ẩn.\r\n\r\n', 'images/danh_gia_sifu_ps4_ps5_hay_nhat_43d1387620724ef4a57d438684890635_grande.webp'),
(37, 'Horizon Zero Dawn Complete Edition - PS4', 880000, 4, 20, 'images/dia-game-ps4-horizon-zero-dawn-complete-edition-P330-1512622672320.jpg', 'Chỉ vừa lúc bạn có suy nghĩ: \"Sao không có game nào để người hang động đánh nhau với khủng long robot nhỉ?\", thì Guerilla Games đã lập tức xuất hiện và đáp trả chính xác câu hỏi của bạn, và đó là một thứ cực kỳ mới lạ, không như những gì mà hãng từng thực hiện. Một tựa game hoàn toàn mới, Horizon: Zero Dawn, một siêu phẩm Guerilla Games tạo ra riêng cho PlayStation 4.', 'images/horizon_zero_dawn__complete_edition_shop_vietnam_grande.jpg'),
(38, 'Pokemon: Let’s Go, Pikachu! - Nintendo Switch (2ND)', 748000, 3, 20, 'images/game-pokemon-lets-go-pikachu---nintendo-switch-2nd-P1359-1732916306741.jpg', 'Một lần nữa, chúng ta được trở lại Kanto, cái nôi của toàn series Pokemon nhưng là trong một tựa game mới hoàn toàn. Pokemon Let\'s Go đang có bán tại nShop. Những cảm xúc vừa thân thương lại vừa lạ lẫm, tươi mới đang đợi bạn phía trước. Hãy mở game lên và tiếp tục giấc mơ nhé.', 'images/shop_game_ban_pokemon_let_go_cho_may_nintendo_switch_grande.jpg'),
(39, 'XBOX ONE Dragon Ball Z: Kakarot', 850000, 2, 20, 'images/49_b5a9b45218ce4160add302ce73c8b548_master.jpg', 'Sống lại câu chuyện của Goku cùng tựa game DRAGON BALL Z: KAKAROT trên máy PS4 PS5 đang có bán tại nShop. Trò chơi sẽ mang lại cho bạn những trận thư hùng mãn nhãn không kém gì trên truyện, trên phim mà chúng ta từng hào hứng theo dõi. Ngoài ra còn nhiều việc khác như luyện tập, câu cá, ăn uống với Goku.\r\nTrải nghiệm phần cốt truyện của DRAGON BALL Z đã khiến biết bao thế hệ say mê. Tự mình tham gia vào các sự kiện hoành tráng, các nhiệm vụ vui thú, và thậm chí là cả các trường đoạn chưa từng thấy trước đây.', 'images/game_shop_ban_dragon_ball_z_kakarot_cho_ps4_c68e67ab842046d3a3b68acf6a5b34a8_grande.webp'),
(40, 'XBOX ONE Mortal Kombat 11: Ultimate Edition', 850000, 2, 20, 'images/44_d5ac112a1bc040389ddd70b838637b98_master.jpg', 'Mortal Kombat đã trở lại và tốt hơn bao giờ hết. Phiên bản mới nhất, hiện đại nhất, Mortal Kombat 11 cho PS5 đang có bán tại nShop. Game mang lại cho bạn khả năng tùy biến đấu sĩ mạnh mẽ, biến họ thực sự chiến đấu theo cách bạn cảm thấy thoải mái nhất. Bên cạnh đó engine đồ họa mới đã nâng tầm bạo liệt cho tất cả các chiêu thức, từ đơn giản đến tất sát đều trở nên thật và bắt mắt không ngờ. Game còn có sự quay trở lại của các đấu sĩ quên thuộc, cũng như thêm các nhân vật mới, tiếp nối cốt truyện hoành tráng của series 25 năm qua', 'images/game_shop_ban_game_mortal_kombat_11_cho_ps4_dc6b410e5aa8498a9121434ccd541990_grande.jpg'),
(41, ' Metroid Prime Remastered', 990000, 3, 20, 'images/41e16caffe7b447ba05bd146235404e5_103766e65078430795b6d61638bb1c0f_master.webp', 'Metroid Prime Remastered cho Nintendo Switch có bán tại nShop sẽ cho bạn được trải nghiệm lại lần nữa chuyến phiêu lưu cực gây cấn của Samus dưới đồ họa, âm thanh lẫn cơ chế điều khiển được làm mới lại! Hãy theo cùng cô chiến đấu với Meta Ridley và tìm cách chấm dứt mối đe dọa cho các thiên hà do Phazon gây ra!\r\nSamus Aran, khi rong ruổi giữa các thiên hà đã vô tình nhận được một tín từ tàu khu trục nhỏ bị kẹt trong quỹ đạo quanh hành tinh Tallon IV. Samus lên đường điều tra và biết được tàu khu trục kia là một tàu nghiên cứu của Cướp biển không gian, là nơi thực hiện nhiều thí nghiệm di truyền học đáng sợ có dùng hợp chất Phazon bí ẩn.\r\n\r\n', 'images/mua_game_metroid_prime_remastered_cho_nintendo_switch_gia_tot_6aae722a5746486d9b9b2d641d785fd7.jpg'),
(42, 'Pokemon Shield', 1250000, 3, 20, 'images/pokemon_shield_nintendo_switch_a8933d798e104f308a4ac4d04846c901_master.webp', 'Vậy là sau bao chờ đợi, tựa game Pokemon RPG chính thống dành cho máy Nintendo Switch cũng đã chính thức ra mắt. Song bản lần này lấy tên là Pokemon Sword và Pokemon Shield.\r\nĐiểm ấn tượng đầu tiên nhất của Pokemon Sword & Shield chính là sự lột xác về đồ hoạ. Đây là lần đầu tiên một game Pokemon sử dụng kiểu góc camera, đồ hoạ hoàn toàn 3D, cho phép nhân vật thực sự di chuyển trong một thế giới rộng lớn. Có thể ngay lập tức thấy rõ sự vượt trội về mặt hình ảnh của Pokemon Sword & Shield so với các bản trước đây. Khung cảnh đẹp và chi tiết, màu sắc hài hoà, thế giới sống động.', 'images/shop_game_ban_pokemon_sword_shield_cho_nintendo_switch_dat_truoc_grande.jpg'),
(43, 'Demon Slayer Kimetsu no Yaiba', 1350000, 3, 20, 'images/demon_slayer_kimetsu_no_yaiba_the_hinokami_chronicles_nintendo_switch_3400a02909ee4074979ed087a52da317_master.webp', 'Demon Slayer Kimetsu no Yaiba The Hinokami Chronicles cho Nintendo Switch bán tại nShop thể hiện cực kỳ chính xác và đẹp mặt dàn nhân vật cũng như chiêu thức của bộ anime Kimetsu no Yaiba nổi tiếng. Những thức kiếm ảo diệu long lanh, những trận chiến nghẹt thở với quỷ đang chờ bạn tham gia.\r\nTrong chế độ Advanture Mode, người chơi sẽ được trải nghiệm lại câu chuyện của Tanjiro Kamado, bám sát theo TV Anime Demon Slayer: Kimetsu no Yaiba. Bắt đầu từ Kamado Tanjiro Risshi Arc của anime, khi Tanjiro gia nhập đội Diệt Quỷ, đối mặt với hàng loạt loài quỷ và kết thúc ở Mugen Train Arc, khi Tanjiro cùng tham gia nhiệm vụ với Viêm Trụ Kyojuro Rengoku.', 'images/_demon_slayer_kimetsu_no_yaiba_the_hinokami_chronicles_nintendo_switch_98e4b9f9dd234be2948b343792b1ca95_grande.jpg'),
(44, 'Diablo 3 Eternal Collection', 880000, 3, 20, 'images/84e4221b9026eff5d350f74_grande_9bf69ee7171c4f5dba06a54873c6a6ce_grande_3dec9db64a1942779bffb64e68bc1817_master.webp', 'Phiên sử thi hoành tráng giữa thiên thần, ác quỷ, và con người đã có mặt trên máy Nintendo Switch tại nShop trong dáng hình game Diablo 3 Eternal Collection. Một tựa game hoành tráng với đầy đủ nội dung của cả ba phần lớn (Diablo III game, Reaper of Souls expansion, và Rise of the Necromancer pack), sẽ mang lại cho bạn sự hưng phấn trong thời gian dài. Không chỉ vậy, Diablo 3 Eternal Collection còn có một số nội dung độc quyền dành riêng cho fan Nintendo rất thú vị.', 'images/mua_game_diablo_3_eternal_collection_nintendo_switch_viet_nam_nshop.jpg'),
(45, 'Super Smash Bros. Ultimate ', 1350000, 3, 20, 'images/ate_cho_nintendo_switch_grande_63efe8aa641a49d582d709d7b8f5dd40_grande_a8557a0fc8e048fe9a4b4c778cfe0078_master.webp', 'Bạn sẽ choáng ngợp bởi những gì Super Smash Bros. Ultimate mang lại trên Nintendo Switch. Game có toàn bộ các nhân vật, sàn đấu, âm nhạc của các bản trước gộp lại. Tính sơ bộ bạn sẽ có 74 đấu sĩ, hơn 100 sàn đấu, hơn 800 track nhạc, còn item thì hàng hà sa số. Ngoài những gương mặt cũ, còn có cả người mới tham gia như Simon Belmont, King K. Rool, Inkling, Ridley. Tất nhiên là sàn đấu cũng có mới luôn (từ Castlevania series, Super Mario Odyssey chẳng hạn). Chưa hết, độ lớn của game sẽ tiếp tục được mở rộng bằng các bản DLC sau phát hành.', 'images/mua_game_super_smash_bros._ultimate_cho_nintendo_switch_tai_nshop_hcm_grande.jpg'),
(46, 'THE LEGEND OF ZELDA: BREATH OF THE WILD', 1280000, 3, 20, 'images/_the_wild_switch_boxart_grande_ddac80bd926646658e57117ee884b8f0_grande_38d548b700104c30b07ffad63b1b1de0_master.webp', '“Tỉnh giấc sau 100 năm ngủ vùi, Link phải khám phá thế giới hoang dã xung quanh để tìm lại những ký ức đã mất của mình và cứu lấy Hyrule.”\r\n\r\n \r\n\r\nKhông phải do may mắn mà The Legend of Zelda: Breath of the Wild lại nhận được nhiều lời tán dương, và số điểm tuyệt đối đến từ hàng loạt trang game uy tín. Đây là tựa game Zelda hay nhất trong vòng 20 năm trở lại đây, đã có mặt trong danh sách những game hay nhất mọi thời đại, thậm chí ở một vài khía cạnh nó còn có khả năng soán ngôi bản Orcarina of Time. Mua ngay đĩa game The Legend of Zelda: Breath of the Wild tại nShop bởi tựa game này đã nâng tiêu chuẩn của thể loại game open-world lên một tầm cao mới. Giờ đây, “thế giới mở” không chỉ đơn thuần là rộng lớn, mà còn phải sống động, chi tiết và đem lại sự tự do thực sự cho người chơi, đúng với tiêu chí “bạn có thể đến bất cứ chỗ nào bạn nhìn thấy”.', 'images/shop_ban_legend_of_zelda_breath_of_the_wild_grande.jpg'),
(47, 'Pokemon Legends Arceus ', 1350000, 3, 20, 'images/pokemon_legends_arceus_nintendo_switch_e9bc6d9db64c4aefae0241ddeec3b4dc_master.webp', 'Pokemon Legends Arceus cho Nintendo Switch có bán ở nShop là một phiên bản game Pokemon hoàn toàn mới nhằm tôn vinh những phiên bản core game từng được phát hành khi kết hợp thêm những yếu tố mới mẻ, mở rộng sự tương tác giữ người chơi với Pokemon và môi trường xung quanh.\r\nPokemon Legends Arceus đưa người chơi về lại vùng đất Hisui rộng lớn. Đây chính là Sinnoh thuở sơ khai trong quá khứ, rất lâu trước khi những thị trấn và thành phố quen thuộc của Pokemon Diamond & Pearl xuất hiện. Thiên nhiên phong phú cùng ngọn núi Coronet sừng sững  nằm tại trung tâm, đây chính là Sinnoh mà người chơi chưa từng được biết đến. Hãy chuẩn bị sẵn sàng để bắt đầu hành trình hoàn thành Pokedex đầu tiên của vùng đất này.\r\n\r\n', 'images/review_game_pokemon_legends_arceus_nintendo_switch_7078e93079d543428154fcea5458571c_grande.webp'),
(48, 'Animal Crossing: New Horizons', 1350000, 3, 20, 'images/animal_crossing_new_horizons_cho_nintendo_switch_de6d61bcfa1d480eb7ccb6fa99dc6806_master.webp', 'Trong phần game mới này, bạn có thể tự tạo dụng vụ, đồ đạc nội thất từ những nguyên liệu mình tìm được. Việc bài trí nhà cửa đã không còn bị giới hạn không gian, bạn tùy ý để vật phẩm của mình ở bất cứ đâu bạn muốn, mang ghế ra ngoài trời ngồi chơi cũng được. Tất nhiên game sẽ không thể thiếu các tính năng kết nối người chơi với nhau như chơi phối hợp, qua thăm đảo của nhau... Một hòn đảo hoang sơ đang chờ bạn biến nó thành thiên đường lý tưởng đấy.', 'images/game_shop_ban_animal_crossing_new_horizons_cho_nintendo_switch_6ca8b518313c442f8cec4c9d45f9717b_grande.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(0, 'Thinh', '123', '2024-12-25 07:53:50');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD KEY `user` (`user_id`),
  ADD KEY `sanpham` (`product_id`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
