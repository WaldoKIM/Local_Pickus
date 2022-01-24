<?php
//////////////////////////////////////////////////////////////////////
////////////////////////////// SEO 시작 //////////////////////////////
//////////////////////////////////////////////////////////////////////
// 제작회사
$seo_Author = "피커스";
$seo_Publisher  = "피커스";

// 웹사이트 타이틀
$seo_head_title = "피커스";

// 대표 도메인
$secure_connection = !empty($_SERVER['HTTPS']); // https 확인
if ($secure_connection == true) {
    $seo_domain_addr = "https://repickus.com";
} else {
    $seo_domain_addr = "http://" . $_SERVER['SERVER_NAME'];
}

// 웹사이트 설명 (서술형 : 80자 이내)
$seo_descriptionS = "우리동네 재활용센터 피커스 중고전문가와 함께 하는 안심거래부터 공간정리까지";

// 웹사이트 설명 (서술형 : 가능한 많이)
$seo_descriptionL = "우리동네 재활용센터 피커스 중고전문가와 함께 하는 안심거래부터 공간정리까지,피커스, 견적신청, 피커스몰, 구매매칭, 쇼핑몰,쇼핑몰판매,쇼핑몰가격,인터넷쇼핑몰,저렴한쇼핑몰,소형쇼핑몰,미니쇼핑몰, mini shop,중고구매, 중고가전구매, 중고가구구매, 중고가전가구구매, 중고TV, 중고가구, 중고가전매장, 중고냉장고, 중고가전판매, 중고세탁기, 중고센터, 중고티비, 중고전자제품, 중고가전직거래, 중고냉장고직거래, 중고물품, 중고가전제품, 중고가구사는곳, 중고온풍기, 중고냉장고판매, 중고가구매매, 중고판매, 중고미니냉장고, 중고드럼세탁기,  중고냉장고세탁기,  중고전기난로, 중고밥솥, 중고원목식탁, 군산중고가전, 중고매장, 중고, 중고제품, 중고태블릿매입, 중고오피스, 중고샵,  중고벼룩시장,  중고가구나라,  중고품, 중고가전렌탈, 중고소형냉장고, 중고가전제품싸게파는곳,  중고구매사이트, 중고가구팔기, 중고쇼핑몰, 중고상품, 중고가게, 중고처분, 중고장터, 중고식탁의자, 중고쇼파, 중고에어컨구매, 중고렌탈 , 중고가전매매, 중고리사이클, 소형중고냉장고, 중고컴퓨터의자, 중고벽걸이에어컨, 중고압력밥솥, 중고가구렌탈, 중고사무용가구, 가전제품중고, 냉장고중고, 중고가전가구매입, 중고김치냉장고, 중고가구처리, 중고리싸이클, 중고사무용품, 중고소형세탁기, 중고에어컨구입, 중고티비매입, 중고이동식에어컨, 중고용품, TV중고, 중고공기청정기, 중고마켓,  김치냉장고중고, 중고가전수거, 중고전기밥솥, 중고센타, 중고쇼파판매, 중고소파판매, 중고판매사이트, 중고가전매입, pickus,  중고가전가구수거, 중고가전대량매입, 안전한중고가전매입, 중고가전가구수거매입 , 피커스중고가전,  중고가전비교견적, 중고가전무료견적, 중고가구판매앱, 중고가전판매앱, 중고가전제품팔기, 가전대량매입신청, 가구대량매입신청, 피커스중고,  중고가전제품견적,  냉장고중고판매앱, 안전한중고가전, 우리동네재활용센터, 동네재활용센터, 가전중고팔기, 중고가전견적신청, 중고가전견적, 대량가구중고거래, 중고가전안심거래, 폐업중고가구 , 중고가전제품수거폐기 , 중고구매매칭, 중고가전가구배송, 중고가전처분, 중고가전가구견적, 구미가전무료수거, 서울중고가전매입, 중고가구견적 , 당근마켓중고가구, 가정용냉장고수거, 중고가전제품, 가전중고구매, 폐업대량판매, 중고가전가구구매, 가정용냉장고매입,  중고가전가구가격,  폐업중고가전,  중고가전팔기, 중고가전가구매입견적, 중고가전제품매입, 중고가전매입판매, 중고가전가구,  서울중고가전배송, 서울중고가구배송, 강남구중고가전매입, 중고가전매입업체, 인천폐업철거, 인천식당폐업철거, 가전중고처분,  인천서구폐업정리, 인천중고가전배송, 식당폐업철거, 식당폐업철거복구, 폐가구무료수거,  당근마켓재활용센터 , 중고세탁기처분 가전중고구매업체, 중고가구배송, 당근마켓가전배송, 가전배송앱, 냉장고중고판매, 중고가전제품팔때, 대구가전폐기, 대전중고가전제품, 대전중고가구, 부산중고가구판매, 부산중고가전매입, 대구중고가전, 청주중고수거, 냉장고수거업체, 냉장고중고구입, 중고냉장고대량매입, 의정부중고가전구매, 부평중고가전, 소형냉장고수거업체, 왕십리중고가전, 장안동냉장고수거,  대량폐업물 , 중고가전수거앱, 냉장고수거배송, 중고세탁기대량매입, 중고가전제품매매, 중고에어컨매입,  중고가전가구무료견적 , 인천중고세탁기, 중고가전판매업체, 중고세탁기가격, 중고냉장고처분, 대전중고세탁기, 폐업대량매입, 폐가전무료수거, 냉장고무료수거, 대구중고가전매입, 중고냉장고, 중고가전, 중고냉장고판매, 중고세탁기구매, 인천중고가전매장, 금천구중고가전, 금천구중고가구매입, 중고가전추천, 중고건조기판매, 중고가구무료수거, 세탁기중고, 중고티비, 중고가구매입, 가구매입, 중고냉장고직거래, 트롬건조기판매, 인천중고가전가구, 울산재활용센터, 울산가구재활용, 수원가구수거, 수원가구폐기, 김치냉장고중고가격, 가전제품무료수거, 중고가전직거래, 중고가구저렴한곳, 가전제품중고수거, 중고가전제품수거, 중고가전제품매입견적, 중고가전매입문의, 중고가전/가구,  에어컨매입신청,  경기중고가전처리, 가전대량매입, 중고세탁기어디서, 대전중고가전, 장안동냉장고수거업체, 중고냉장고추천, 대형가전서비스센터, 중고가전제품업체, 중고세탁기, 중고가전제품사이트, 중고가구판매, 당근마켓대형가전, 가전제품수거, 냉장고중고매입, 중고가전매입센터, 재활용센터, 중고가전판매, 사무용가구매입, 중고가전사이트, 중고가전매매, 중고세탁기판매, 드럼세탁기매입, 중고냉장고매입가격비교, 중고가전가구비교견적, 중고가전매입신청, 냉장고처분, 세탁기처분, 대형가전중고, 중고대형가전, 중고가전매장, 중고냉장고가격, 냉장고중고, 인천중고가전, 김치냉장고중고, 중고건조기, 중고냉장고매입 티비중고, 중고드럼세탁기 , 중고가전매입, 중고가전가구수거, 중고가전대량매입, 안전한중고가전매입, 중고가전가구수거매입, 피커스중고가전, 중고가전비교견적, 중고가전무료견적,  당근마켓비교견적,  중고가전가격비교,  폐업준비,  폐업매물,  폐업물품,  피커스중고,  당근마켓중고처분, 번개장터대형가전,  안전한중고가전, 중고나라중고가전,  대량폐업물품,  폐업물품처분,  중고가전견적신청, 중고가전견적, 대량가구중고거래, 중고가전안심거래, 폐업중고가구,  중고가전제품수거폐기,  중고구매매칭, 중고가전가구배송, 중고가전처분,  중고가전가구견적, 디휴브,  피커스,  중고가구견적,  당근마켓중고가구,  당근마켓대형가전,  중고가전제품, 가전중고구매, 폐업대량판매, 중고나라폐업처분,  중고가구판매, 중고가전제품사이트, 폐업중고가전,  중고가전제품업체,  중고가전가구매입견적, 중고가전제품매입, 중고나라대형가전,  중고가전가구,  중고가전A/S,  중고가전가격대,  중고전문가,  중고전문배송,  중고가전판매,  업소용가전처분,  가전중고처분,  당근마켓폐업처분,  당근마켓가전판매,  당근마켓중고가전, 당근마켓재활용센터,  번개장터중고판매,  번개장터중고처분,  번개장터중고가구, 번개장터중고가전,  번개장터폐업처분,  중고나라중고처분,  업소용중고가전,  업소용중고,  급매물처분,  대형가전가구,  중고매물처분,  중고가전가구무료견적, 중고무료비교견적, 중고거래견적, 안전한중고거래사이트,  중고물품처분,  비대면중고거래,  비대면중고가전,  비대면중고가구,  중고전문가거래,  폐업처분,  폐업가전,  폐업폐기,  폐업준비처분,  중고가전매입,  중고가전가구수거, 중고가전대량매입, 안전한중고가전매입,  중고가전가구수거매입,   피커스중고가전,   중고가전비교견적,   중고가전무료견적,   중고가구판매앱,  중고가전판매앱, 중고가전제품팔기, 가전대량매입신청, 가구대량매입신청, 피커스중고,  중고가전제품견적,  냉장고중고판매앱,  안전한중고가전, 우리동네재활용센터, 동네재활용센터, 가전중고팔기, 중고가전견적신청, 중고가전견적, 대량가구중고거래, 중고가전안심거래,  폐업중고가구,  중고가전제품수거폐기,  중고매트리스팔기,  중고가전가구배송, 중고가전처분,  중고가전가구견적,   중고가구견적, 중고가전가구판매앱 가정용냉장고수거, 소형가전팔기,  중고가전가구매입,  중고견적신청,  중고가전가구구매,  가정용냉장고매입,  중고가전가구가격,  중고가전가구판매,  중고가전팔기,  중고가전가구매입견적, 피커스후기,  중고가전쉽게팔기,  중고가전가구,  중고가구팔기,  중고가전빨리팔기, 견적신청이야기,  견적신청사연,  토탈앤리싸이클,  소망알뜰매장,  해신주방,  중고팡,  인기가전제품,  인기중고가전,  건조기사용방법,  폐가전무료수거, 중고냉장고, 가전제품무료수거, 중고가전, 폐가구무료수거, 중고세탁기, 재활용센터, 중고가전매입, 중고티비, 중고가구매입, 중고가전매장, 대전중고가전, 냉장고중고, 대구중고가전, 중고가전판매, 중고에어컨매입, 중고냉장고가격, 세탁기중고, 냉장고중고판매, 중고가구무료수거, 대전중고가구, 중고세탁기판매, 인천중고가전, 중고가전제품, 가전제품수거, 김치냉장고중고, 중고건조기, 중고냉장고매입, 중고냉장고판매, 중고가구판매, 울산재활용센터, 티비중고, 인천중고가전매장, 대구중고가전매입, 냉장고중고매입, 폐가전무료수거, 중고냉장고, 중고가전, 폐가구무료수거, 중고가전매입, 중고티비, 중고가구매입, 대전중고가전, 대구중고가전, 중고에어컨매입, 세탁기중고, 냉장고중고판매, 중고가구무료수거, 대전중고가구, 중고가전제품,  중고드럼세탁기 , 중고냉장고판매, 중고가구판매, 인천중고가전매장, 냉장고무료수거, 대구중고가전매입, 가구매입, 중고세탁기가격, 중고냉장고직거래, 중고가전제품매입, 부평중고가전, 부산중고가전매입, 대전중고세탁기, 인천중고세탁기, 서울중고가전매입, 금천구중고가전, 중고가전처분, 대전중고가전제품, 중고건조기판매, 부산중고가구판매, 냉장고수거업체, 중고가전매입, 중고가전제품, 중고가구판매, 중고가전가구,  업소용중고,  폐업물품,  비대면중고거래,  업소용중고가전,  중고가전처분,  폐업준비,  폐업처분,  폐업중고가구";

// 키워드 (단어형 : 가능한 많이)  예) 프로그램개발,디자인
$seo_keywords = "중고,중고가전매입,중고판매,중고구매,냉장고,티비,세탁시,중고냉장고,중고세탁기,주방집기매입,중고거래,가전,가구,대형가전,대형가구,중고가전,중고가구,중고대형가전,중고대형가구,재활용센터,폐기,수거,철거,피커스,중고가전가구,중고매입,이사,가전철거,가전수거,가전폐기,중고가전폐기,중고가구폐기,무료수거,이사,폐기,철거,재활용업체,피커스, 견적신청, 피커스몰, 구매매칭, 쇼핑몰,쇼핑몰판매,쇼핑몰가격,인터넷쇼핑몰,저렴한쇼핑몰,소형쇼핑몰,미니쇼핑몰, mini shop,중고구매, 중고가전구매, 중고가구구매, 중고가전가구구매, 중고TV, 중고가구, 중고가전매장, 중고냉장고, 중고가전판매, 중고세탁기, 중고센터, 중고티비, 중고전자제품, 중고가전직거래, 중고냉장고직거래, 중고물품, 중고가전제품, 중고가구사는곳, 중고온풍기, 중고냉장고판매, 중고가구매매, 중고판매, 중고미니냉장고, 중고드럼세탁기,  중고냉장고세탁기,  중고전기난로, 중고밥솥, 중고원목식탁, 군산중고가전, 중고매장, 중고, 중고제품, 중고태블릿매입, 중고오피스, 중고샵,  중고벼룩시장,  중고가구나라,  중고품, 중고가전렌탈, 중고소형냉장고, 중고가전제품싸게파는곳,  중고구매사이트, 중고가구팔기, 중고쇼핑몰, 중고상품, 중고가게, 중고처분, 중고장터, 중고식탁의자, 중고쇼파, 중고에어컨구매, 중고렌탈 , 중고가전매매, 중고리사이클, 소형중고냉장고, 중고컴퓨터의자, 중고벽걸이에어컨, 중고압력밥솥, 중고가구렌탈, 중고사무용가구, 가전제품중고, 냉장고중고, 중고가전가구매입, 중고김치냉장고, 중고가구처리, 중고리싸이클, 중고사무용품, 중고소형세탁기, 중고에어컨구입, 중고티비매입, 중고이동식에어컨, 중고용품, TV중고, 중고공기청정기, 중고마켓,  김치냉장고중고, 중고가전수거, 중고전기밥솥, 중고센타, 중고쇼파판매, 중고소파판매, 중고판매사이트, 중고가전매입, pickus,  중고가전가구수거, 중고가전대량매입, 안전한중고가전매입, 중고가전가구수거매입 , 피커스중고가전,  중고가전비교견적, 중고가전무료견적, 중고가구판매앱, 중고가전판매앱, 중고가전제품팔기, 가전대량매입신청, 가구대량매입신청, 피커스중고,  중고가전제품견적,  냉장고중고판매앱, 안전한중고가전, 우리동네재활용센터, 동네재활용센터, 가전중고팔기, 중고가전견적신청, 중고가전견적, 대량가구중고거래, 중고가전안심거래, 폐업중고가구 , 중고가전제품수거폐기 , 중고구매매칭, 중고가전가구배송, 중고가전처분, 중고가전가구견적, 구미가전무료수거, 서울중고가전매입, 중고가구견적 , 당근마켓중고가구, 가정용냉장고수거, 중고가전제품, 가전중고구매, 폐업대량판매, 중고가전가구구매, 가정용냉장고매입,  중고가전가구가격,  폐업중고가전,  중고가전팔기, 중고가전가구매입견적, 중고가전제품매입, 중고가전매입판매, 중고가전가구,  서울중고가전배송, 서울중고가구배송, 강남구중고가전매입, 중고가전매입업체, 인천폐업철거, 인천식당폐업철거, 가전중고처분,  인천서구폐업정리, 인천중고가전배송, 식당폐업철거, 식당폐업철거복구, 폐가구무료수거,  당근마켓재활용센터 , 중고세탁기처분 가전중고구매업체, 중고가구배송, 당근마켓가전배송, 가전배송앱, 냉장고중고판매, 중고가전제품팔때, 대구가전폐기, 대전중고가전제품, 대전중고가구, 부산중고가구판매, 부산중고가전매입, 대구중고가전, 청주중고수거, 냉장고수거업체, 냉장고중고구입, 중고냉장고대량매입, 의정부중고가전구매, 부평중고가전, 소형냉장고수거업체, 왕십리중고가전, 장안동냉장고수거,  대량폐업물 , 중고가전수거앱, 냉장고수거배송, 중고세탁기대량매입, 중고가전제품매매, 중고에어컨매입,  중고가전가구무료견적 , 인천중고세탁기, 중고가전판매업체, 중고세탁기가격, 중고냉장고처분, 대전중고세탁기, 폐업대량매입, 폐가전무료수거, 냉장고무료수거, 대구중고가전매입, 중고냉장고, 중고가전, 중고냉장고판매, 중고세탁기구매, 인천중고가전매장, 금천구중고가전, 금천구중고가구매입, 중고가전추천, 중고건조기판매, 중고가구무료수거, 세탁기중고, 중고티비, 중고가구매입, 가구매입, 중고냉장고직거래, 트롬건조기판매, 인천중고가전가구, 울산재활용센터, 울산가구재활용, 수원가구수거, 수원가구폐기, 김치냉장고중고가격, 가전제품무료수거, 중고가전직거래, 중고가구저렴한곳, 가전제품중고수거, 중고가전제품수거, 중고가전제품매입견적, 중고가전매입문의, 중고가전/가구,  에어컨매입신청,  경기중고가전처리, 가전대량매입, 중고세탁기어디서, 대전중고가전, 장안동냉장고수거업체, 중고냉장고추천, 대형가전서비스센터, 중고가전제품업체, 중고세탁기, 중고가전제품사이트, 중고가구판매, 당근마켓대형가전, 가전제품수거, 냉장고중고매입, 중고가전매입센터, 재활용센터, 중고가전판매, 사무용가구매입, 중고가전사이트, 중고가전매매, 중고세탁기판매, 드럼세탁기매입, 중고냉장고매입가격비교, 중고가전가구비교견적, 중고가전매입신청, 냉장고처분, 세탁기처분, 대형가전중고, 중고대형가전, 중고가전매장, 중고냉장고가격, 냉장고중고, 인천중고가전, 김치냉장고중고, 중고건조기, 중고냉장고매입 티비중고, 중고드럼세탁기 , 중고가전매입, 중고가전가구수거, 중고가전대량매입, 안전한중고가전매입, 중고가전가구수거매입, 피커스중고가전, 중고가전비교견적, 중고가전무료견적,  당근마켓비교견적,  중고가전가격비교,  폐업준비,  폐업매물,  폐업물품,  피커스중고,  당근마켓중고처분, 번개장터대형가전,  안전한중고가전, 중고나라중고가전,  대량폐업물품,  폐업물품처분,  중고가전견적신청, 중고가전견적, 대량가구중고거래, 중고가전안심거래, 폐업중고가구,  중고가전제품수거폐기,  중고구매매칭, 중고가전가구배송, 중고가전처분,  중고가전가구견적, 디휴브,  피커스,  중고가구견적,  당근마켓중고가구,  당근마켓대형가전,  중고가전제품, 가전중고구매, 폐업대량판매, 중고나라폐업처분,  중고가구판매, 중고가전제품사이트, 폐업중고가전,  중고가전제품업체,  중고가전가구매입견적, 중고가전제품매입, 중고나라대형가전,  중고가전가구,  중고가전A/S,  중고가전가격대,  중고전문가,  중고전문배송,  중고가전판매,  업소용가전처분,  가전중고처분,  당근마켓폐업처분,  당근마켓가전판매,  당근마켓중고가전, 당근마켓재활용센터,  번개장터중고판매,  번개장터중고처분,  번개장터중고가구, 번개장터중고가전,  번개장터폐업처분,  중고나라중고처분,  업소용중고가전,  업소용중고,  급매물처분,  대형가전가구,  중고매물처분,  중고가전가구무료견적, 중고무료비교견적, 중고거래견적, 안전한중고거래사이트,  중고물품처분,  비대면중고거래,  비대면중고가전,  비대면중고가구,  중고전문가거래,  폐업처분,  폐업가전,  폐업폐기,  폐업준비처분,  중고가전매입,  중고가전가구수거, 중고가전대량매입, 안전한중고가전매입,  중고가전가구수거매입,   피커스중고가전,   중고가전비교견적,   중고가전무료견적,   중고가구판매앱,  중고가전판매앱, 중고가전제품팔기, 가전대량매입신청, 가구대량매입신청, 피커스중고,  중고가전제품견적,  냉장고중고판매앱,  안전한중고가전, 우리동네재활용센터, 동네재활용센터, 가전중고팔기, 중고가전견적신청, 중고가전견적, 대량가구중고거래, 중고가전안심거래,  폐업중고가구,  중고가전제품수거폐기,  중고매트리스팔기,  중고가전가구배송, 중고가전처분,  중고가전가구견적,   중고가구견적, 중고가전가구판매앱 가정용냉장고수거, 소형가전팔기,  중고가전가구매입,  중고견적신청,  중고가전가구구매,  가정용냉장고매입,  중고가전가구가격,  중고가전가구판매,  중고가전팔기,  중고가전가구매입견적, 피커스후기,  중고가전쉽게팔기,  중고가전가구,  중고가구팔기,  중고가전빨리팔기, 견적신청이야기,  견적신청사연,  토탈앤리싸이클,  소망알뜰매장,  해신주방,  중고팡,  인기가전제품,  인기중고가전,  건조기사용방법,  폐가전무료수거, 중고냉장고, 가전제품무료수거, 중고가전, 폐가구무료수거, 중고세탁기, 재활용센터, 중고가전매입, 중고티비, 중고가구매입, 중고가전매장, 대전중고가전, 냉장고중고, 대구중고가전, 중고가전판매, 중고에어컨매입, 중고냉장고가격, 세탁기중고, 냉장고중고판매, 중고가구무료수거, 대전중고가구, 중고세탁기판매, 인천중고가전, 중고가전제품, 가전제품수거, 김치냉장고중고, 중고건조기, 중고냉장고매입, 중고냉장고판매, 중고가구판매, 울산재활용센터, 티비중고, 인천중고가전매장, 대구중고가전매입, 냉장고중고매입, 폐가전무료수거, 중고냉장고, 중고가전, 폐가구무료수거, 중고가전매입, 중고티비, 중고가구매입, 대전중고가전, 대구중고가전, 중고에어컨매입, 세탁기중고, 냉장고중고판매, 중고가구무료수거, 대전중고가구, 중고가전제품,  중고드럼세탁기 , 중고냉장고판매, 중고가구판매, 인천중고가전매장, 냉장고무료수거, 대구중고가전매입, 가구매입, 중고세탁기가격, 중고냉장고직거래, 중고가전제품매입, 부평중고가전, 부산중고가전매입, 대전중고세탁기, 인천중고세탁기, 서울중고가전매입, 금천구중고가전, 중고가전처분, 대전중고가전제품, 중고건조기판매, 부산중고가구판매, 냉장고수거업체, 중고가전매입, 중고가전제품, 중고가구판매, 중고가전가구,  업소용중고,  폐업물품,  비대면중고거래,  업소용중고가전,  중고가전처분,  폐업준비,  폐업처분,  폐업중고가구";

$seo_image = $seo_domain_addr . "/images/visual_img.png";
$seo_image_width  = "200";
$seo_image_height = "150";

$seo_og_image = $seo_domain_addr . "/images/visual_img.png";
$seo_og_image_width  = "1200";
$seo_og_image_height = "630";

$seo_og_image = $seo_domain_addr . "/images/visual_img.png";
$seo_twitter_image_width  = "800";
$seo_twitter_image_height = "418";

// 페이스북 아이디
$seo_facebook = "pickus2";

// 트위터 아이디
$seo_twitter = "";

// Naver naver-site-verification 값
$naver_site_verification = "de105873c91faa0ed0161b04fd8f676b378fc5e1";

// Naver 아이디
$seo_naver = "pickus";

// Naver 스마트팜 아이디
$seo_naver_storefarm = "";

//인스타그람 아이디
$seo_insta = "official_pickus";

////////////////////////////////////////////////////////////////////
/////////////////////  이하 수정사항 없습니다. /////////////////////
////////////////////////////////////////////////////////////////////
// 제작회사
if ($config['cf_title']) $seo_Author = "{$config['cf_title']}";
if ($config['cf_title']) $seo_Publisher  = "{$config['cf_title']}";

// 웹사이트 타이틀
if ($config['cf_title']) $seo_head_title = "{$config['cf_title']}";

$gnu_seo_Publisher  = "{$seo_Author}";
$gnu_seo_Author     = ($wr_id) ? $write['wr_name'] : $seo_Publisher;
$gnu_seo_head_title = $g5_head_title;

if ($gnu_seo_Publisher) $seo_Publisher = $gnu_seo_Publisher;
if ($gnu_seo_Author) $seo_Author = $gnu_seo_Author;
if ($gnu_seo_head_title) $seo_head_title = $gnu_seo_head_title;

// 오늘 날짜
$seo_datetime = date("Y-m-d");

if ($bo_table) {
    if ($wr_id) {
        $seo_qry = sql_query(" select * from {$g5['write_prefix']}{$bo_table} where wr_id='{$wr_id}' ");
        $seo_row = sql_fetch_array($seo_qry);

        $seo_wr_datetime = $seo_row['wr_datetime'];
        if (strpos($seo_row['wr_option'], "secret") !== false) {
            $seo_descriptionL = $g5_head_title;
            $seo_descriptionS = $g5_head_title;
            $seo_keywords     = $g5_head_title;
        } else {
            $seo_description = str_replace('<br />', ' ', $seo_row['wr_content']); // &nbsp; 를 공백으로 교체하기
            $seo_description = str_replace('<br>', ' ', $seo_description); // &nbsp; 를 공백으로 교체하기
            $seo_description = str_replace('"', ' ', $seo_description); // " 를 공백으로 교체하기
            $seo_description = str_replace('&nbsp;', ' ', $seo_description); // &nbsp; 를 공백으로 교체하기
            $seo_description = preg_replace('/[\x00-\x1F\x7F]/', '', $seo_description); // 이상한 특수문자를 제어하는 코드 추가
            $seo_keywords     = strip_tags($seo_description) . ", " . $seo_keywords;
            $seo_descriptionL = strip_tags($seo_description) . ", " . $seo_descriptionL;
            $seo_descriptionS = cut_str(strip_tags($seo_description), 80) . ", " . $seo_descriptionS;
            $gnu_seo_datetime     = substr($seo_row['wr_datetime'], 0, 10);
            if ($seo_row['wr_last'] > $seo_row['wr_datetime'])
                $gnu_seo_datetime     = substr($seo_row['wr_last'], 0, 10);
        }

        // 썸네일 or 로고경로 (최소 200 x 200픽셀)
        include_once(G5_LIB_PATH . '/thumbnail.lib.php');
        $seo_thumb = get_list_thumbnail($bo_table, $wr_id, $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);

        if ($seo_thumb['src']) {
            $seo_image        = $seo_thumb['src'];
            $seo_image_width  = $board['bo_gallery_width'];
            $seo_image_height = $board['bo_gallery_height'];
        } /*else {
            if (preg_match("/<img.*src=\\\"(.*)\\\"/iUs", stripslashes($seo_row['wr_content']), $seo_tmp)) { // 에디터 이미지추출
                $seo_file = str_replace(G5_BBS_URL, "..",$seo_tmp[1]); // 파일명
                if (is_file($seo_file)) {
                    $seo_thumb = thumbnail($seo_file, $board['bo_gallery_width'], $board['bo_gallery_height'], 0, 1, 90, 0, "",  99, $noimg); // 에디터 썸네일
                    $seo_image        = $seo_thumb['src'];
                    $seo_image_width  = $board['bo_gallery_width'];
                    $seo_image_height = $board['bo_gallery_height'];
                }
            }
        }*/
    } else {
        if ($g5_head_title) {
            $seo_descriptionL = $g5_head_title . ", " . $seo_descriptionL;
            $seo_descriptionS = $g5_head_title . ", " . $seo_descriptionS;
            $seo_keywords = $g5_head_title . ", " . $seo_keywords;
        }
    }
}

if ($gnu_seo_datetime) $seo_datetime = $gnu_seo_datetime;

echo "<meta name=\"referrer\" content=\"no-referrer-when-downgrade\">\r\n";
echo "<meta name=\"robots\" content=\"all\">\r\n";

echo "\r\n";
// 사이트 언어
echo "<meta http-equiv=\"content-language\" content=\"kr\">\r\n";  // kr

// 대표도메인 (선호 URL)
echo "<link rel=\"canonical\" href=\"{$seo_domain_addr}\">\r\n";

// 만든사람
echo "<meta name=\"Author\" contents=\"{$seo_Author}\">\r\n";
echo "<meta name=\"Publisher\" content=\"{$seo_Author}\">\r\n";
echo "<meta name=\"Other Agent\" content=\"{$seo_Author}\">\r\n";
echo "<meta name=\"copyright\" content=\"{$seo_Author}\">\r\n";

//  제작일 예) 2017-03-29
echo "<meta name=\"Author-Date\" content=\"{$seo_datetime}\" scheme=\"YYYY-MM-DD\">\r\n";
echo "<meta name=\"Date\" content=\"{$seo_datetime}\" scheme=\"YYYY-MM-DD\">\r\n";

// 사이트 제목
echo "<meta name=\"subject\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"title\" content=\"{$seo_head_title}\">\r\n";

// 설명
echo "<meta name=\"Distribution\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta name=\"description\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta name=\"Descript-xion\" content=\"{$seo_descriptionL}\">\r\n";

// 키워드
echo "<meta name=\"keywords\" content=\"{$seo_keywords}\">\r\n";

// 소셜 검색
echo "<meta itemprop=\"name\" content=\"{$seo_head_title}\">\r\n";
echo "<meta itemprop=\"description\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta itemprop=\"image\" content=\"{$seo_image}\">\r\n";

// Open Graph: 네임스페이스가 지정된 meta 태그를 사용하여 메타데이터
echo "<meta property=\"og:locale\" content=\"ko_KR\">\r\n";  // ko_KR
echo "<meta property=\"og:locale:alternate\" content=\"ko_KR\">\r\n";
//echo "<meta property=\"og:locale:alternate\" content=\"en_EN\">\r\n";
echo "<meta property=\"og:author\" content=\"{$seo_Author}\">\r\n";
echo "<meta property=\"og:type\" content=\"website\">\r\n";
echo "<meta property=\"og:site_name\" content=\"{$seo_head_title}\">\r\n";
echo "<meta property=\"og:title\" id=\"ogtitle\" itemprop=\"name\" content=\"{$seo_head_title}\">\r\n";
echo "<meta property=\"og:description\" id=\"ogdesc\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta property=\"og:url\" content=\"{$seo_domain_addr}{$_SERVER['REQUEST_URI']}\">\r\n";
echo "<meta property=\"og:image\" id=\"ogimg\" content=\"{$seo_og_image}\">\r\n";
echo "<meta property=\"og:image:width\" content=\"{$seo_og_image_width}\">\r\n";
echo "<meta property=\"og:image:height\" content=\"{$seo_og_image_height}\">\r\n";
if ($wr_id) {
    echo "<meta property=\"og:updated_time\" content=\"" . substr($seo_wr_datetime, 0, 10) . "T" . substr($seo_wr_datetime, 11, 18) . "+09:00\">\r\n";
}

// iOS
echo "<meta name=\"apple-mobile-web-app-title\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"format-detection\" content=\"telephone=no\">\r\n";

// Android
echo "<meta name=\"theme-color\" content=\"#000000\">\r\n";

// twitter
if ($seo_twitter) {
    echo "<meta name=\"twitter:site\" content=\"@{$seo_twitter}\">\r\n";
    echo "<meta name=\"twitter:creator\" content=\"@{$seo_twitter}\">\r\n";
}
echo "<meta name=\"twitter:title\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"twitter:description\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta name=\"twitter:domain\" content=\"{$seo_domain_addr}\">\r\n";
echo "<meta name=\"twitter:url\" content=\"{$seo_domain_addr}{$_SERVER['REQUEST_URI']}\">\r\n";
echo "<meta name=\"twitter:image\" content=\"{$seo_twitter_image}\">\r\n";
echo "<meta name=\"twitter:image:width\" content=\"{$seo_twitter_image_width}\">\r\n";
echo "<meta name=\"twitter:image:height\" content=\"{$seo_twitter_image_height}\">\r\n";
echo "<meta name=\"twitter:card\" content=\"summary\">\r\n"; // summary, photo, player , 신청: https://cards-dev.twitter.com/validator

// Naver
if ($naver_site_verification) {
    echo "<meta name=\"naver-site-verification\" content=\"{$naver_site_verification}\">\r\n";
}

// // 사이트 연관 채널
// echo "<span itemscope=\"\" itemtype=\"http://schema.org/Organization\">\r\n";
// echo "    <link itemprop=\"url\" href=\"{$seo_domain_addr}\">\r\n";
// if ($seo_facebook) echo "    <a itemprop=\"sameAs\" href=\"https://www.facebook.com/{$seo_facebook}\"></a>\r\n";
// if ($seo_twitter) echo "    <a itemprop=\"sameAs\" href=\"https://twitter.com/{$seo_twitter}\"></a>\r\n";
// if ($seo_naver) echo "    <a itemprop=\"sameAs\" href=\"http://blog.naver.com/{$seo_naver}\"></a>\r\n";
// if ($seo_naver_storefarm) echo "    <a itemprop=\"sameAs\" href=\"http://storefarm.naver.com/{$seo_naver_storefarm}\"></a>\r\n";
// if ($seo_insta) echo "    <a itemprop=\"sameAs\" href=\"https://www.instagram.com/{$seo_insta}\"></a>\r\n";
// echo "</span>\r\n";

echo "<!-- SEO 끝 -->";
echo "\r\n";
////////////////////////////////////////////////////////////////////
////////////////////////////// SEO 끝 //////////////////////////////
////////////////////////////////////////////////////////////////////
