// html dom 이 다 로딩된 후 실행된다.
$(document).ready(function(){
    // 1. Sidebar toggle behavior
   $('#sidebarCollapse').on('click', function() {
     $('#sidebar').toggleClass('active');
   });
    
    // 2. Sidebar memu a 태그를 클릭했을때 하위메뉴 오픈
    $(".nav-item>a").click(function(){
        var submenu = $(this).next("ul");

        // submenu 가 화면상에 보일때는 위로 보드랍게 접고 아니면 아래로 보드랍게 펼치기
        if( submenu.is(":visible") ){
            submenu.slideUp();
        }else{
            submenu.slideDown();
        }
    });
    
    $(document).on('click', '.toggleBG', function () {
        var toggleBG = $(this);
        var toggleFG = $(this).find('.toggleFG');
        var left = toggleFG.css('left');
        
        if(left == '40px') {
            toggleBG.css('background', '#CCCCCC');
            toggleActionStart(toggleFG, 'TO_LEFT');
        }else if(left == '0px') {
            toggleBG.css('background', '#126febe6');
            toggleActionStart(toggleFG, 'TO_RIGHT');
        }
        
        
        $( '.board_type01.compared' ).toggle();
        
        //메인 표 와 비교 표 에 xxx 클래스 추가
        $('.board_type01').toggleClass('type_col2');
    });

	//메뉴 작업
    let nowuri = location.pathname;
    let menu = $('.vertical-nav .nav .nav-item');
    if(nowuri.indexOf('index03.html') > -1 || nowuri.indexOf('index04.html') > -1 || nowuri.indexOf('index05.html') > -1 || nowuri.indexOf('index06.html') > -1){
        menu.eq(0).addClass('active');
        menu.eq(0).find('ul.nav_sub').show().find('li:eq(0) > a').addClass('active');
    } else if(nowuri.indexOf('index03_2.html') > -1){
        menu.eq(0).addClass('active');
        menu.eq(0).find('ul.nav_sub').show().find('li:eq(1) > a').addClass('active');
    } else if(nowuri.indexOf('index03_3.html') > -1){
        menu.eq(3).addClass('active');
    } else if(nowuri.indexOf('index07.html') > -1 || nowuri.indexOf('index08.html') > -1 || nowuri.indexOf('index09.html') > -1 || nowuri.indexOf('index10.html') > -1){
        menu.eq(1).addClass('active');
        menu.eq(1).find('ul.nav_sub').show().find('li:eq(0) > a').addClass('active');
    } else if(nowuri.indexOf('index11.html') > -1 || nowuri.indexOf('index12.html') > -1 || nowuri.indexOf('index13.html') > -1 || nowuri.indexOf('index14.html') > -1){
        menu.eq(1).addClass('active');
        menu.eq(1).find('ul.nav_sub').show().find('li:eq(1) > a').addClass('active');
    } else if(nowuri.indexOf('index15.html') > -1 || nowuri.indexOf('index16.html') > -1 || nowuri.indexOf('index17.html') > -1 || nowuri.indexOf('index18.html') > -1){
        menu.eq(1).addClass('active');
        menu.eq(1).find('ul.nav_sub').show().find('li:eq(2) > a').addClass('active');
    } else if(nowuri.indexOf('index19.html') > -1){
        menu.eq(2).addClass('active');
        menu.eq(2).find('ul.nav_sub').show().find('li:eq(0) > a').addClass('active');
    } else if(nowuri.indexOf('index20.html') > -1){
        menu.eq(2).addClass('active');
        menu.eq(2).find('ul.nav_sub').show().find('li:eq(1) > a').addClass('active');
    } else if(nowuri.indexOf('index22_2.html') > -1){
        menu.eq(2).addClass('active');
        menu.eq(2).find('ul.nav_sub').show().find('li:eq(2) > a').addClass('active');
    } else if(nowuri.indexOf("index31.html") > -1 || nowuri.indexOf('index32.html') > -1 || nowuri.indexOf('index33.html') > -1 || nowuri.indexOf('index34.html') > -1){
        menu.eq(5).addClass('active');
    } else if(nowuri.indexOf('index36.html') > -1){
        menu.eq(4).addClass('active');
    }

    //파일 선택 시 선택한 파일 이름 출력
    $('.file_upload').on('change', 'input[name="files"]', function(e){
        let fileValue = $(this).val().split("\\");
        let fileName = fileValue[fileValue.length - 1];
        let fileCnt = $(this).attr('id').replace('file', '');
        $('.file_oriName' + fileCnt).text(fileName);
    });
    //파일 추가 버튼 클릭 시 파일첨부 버튼 추가
    $('.file_upload .plus').click(function(){
        let fileCnt = $('.file_upload > .btn_left').last().find('input').attr('id').replace('file', '');
        let fileHtml = '<div class="btn_left">'+
                        '<button class="btn btn-plus" onclick="javascript:document.getElementById(\'file'+(fileCnt + 1)+'\').click();">파일첨부</button>'+
                        '<span class="file_oriName'+(fileCnt + 1)+'"></span>'+
                        '<input type="file" id="file'+(fileCnt + 1)+'" name="files" style="display: none;">'+
                    '</div>';
        $('.file_upload').append(fileHtml);
    });
    if($('.carousel').length > 0){
        //$('.carousel').carousel();   
        $('.owlCarousel').owlCarousel({
            items : 3
        });   

        $('.carousel').carousel();   
    }
    $('#attr_value_tbody').on('click', '.btn_minus', function(){
        let idx = $('.btn_minus').index($(this));
        let popHTML = '<div class="pop01">'
                +'<p class="pop_txt01">삭제하시겠습니까?</p>'
                +'<button type="button" onclick="javascript:$(this).parent(\'.pop01\').remove();" class="btn btn-danger">취소</button>'
                +'<button type="button" onclick="attr_value_remove('+idx+');" class="btn btn-delete">삭제</button>'
                +'</div>';
        $(document.body).append(popHTML);
    });

    $('.btn_plus').click(function(){
        let popHTML = '<div class="pop02">'
                +'<p style="margin:0 0 15px 0;"><input title="내용 입력" class="risk" type="text" placeholder="내용을 입력해주세요." value=""></p>'
                +'<button type="button" onclick="javascript:$(this).parent(\'.pop02\').hide();" class="btn btn-danger">닫기</button>'
                +'<button type="button" onclick="attr_value_add();" class="btn btn-primary">추가</button>'
                +'</div>';
        $(document.body).append(popHTML);
    });

    $('#workSelect').change(function(){
        $('#searchCnd1').toggle();
    });
    $('#dateSelect').change(function(){
        if($(this).prop('checked')){
            $('#dateSelectCheck').css('display', 'inline-block');
        } else {
            $('#dateSelectCheck').hide();
        }
    });
    $('#searchCnd2').change(function(){
        let val = $(this).val();
        $('#pDate').empty();
        if(val == 'D'){
            $('#pDate').append('<input title="날짜 입력" type="date" placeholder="" value="">');
            $('#pDate').show();
        } else if(val == 'P') {
            $('#pDate').append('<input title="날짜 입력" type="date" placeholder="" value=""> ~ ');
            $('#pDate').append('<input title="날짜 입력" type="date" placeholder="" value="">');
            $('#pDate').show();
        } else {
            $('#pDate').hide();
        }
    });

    $('#sel_work, #sel_attr_val').change(function(){
        let pickAttrText = $(this).find('option:selected').text();
        if(pickAttrText == '선택안함'){
            return ;
        }
        let dupcheck = false;
        $('.selectAttrText').each(function(i, v){
            if($(this).text() == pickAttrText){
                dupcheck = true;
            }
        });
        if(dupcheck){
            alert('이미 선택한 작업 및 속성입니다.');
            return ;
        }

        let pickAttr = '';
        pickAttr = '<div class="selectAttrBG">'
                        +'<span class="selectAttrText">'+pickAttrText+'</span>'
                        +'<button class="selectDeleteFG">X</button>'
                    +'</div>';
        $('#selectAttrList').append(pickAttr);
    });

    $('#selectAttrList').on('click', '.selectDeleteFG', function(){
        let parentEl = $(this).parent('.selectAttrBG');
        parentEl.remove();
    });

    $('#fileListModal').on('show.bs.modal', function(e){
        let btnEl = $(e.relatedTarget);
        let number = btnEl.data('number');
        $('#fileListModal #fileListModalLabel').html(number + '번 파일 목록');
        //파일 목록 가져오기
    });

    $('#riskManageModal').on('show.bs.modal', function(e){
        let btnEl = $(e.relatedTarget);
        let text = btnEl.html();
        $('#riskManageModal #riskManageModalLabel').html('위험성평가 '+ text);
        $('#riskManageModal .modal-footer .btn-primary').html(text);

        if(text == '수정'){
            let workdate = btnEl.data('workdate');
            let workgubun = btnEl.data('workgubun');
            $(this).find('#opt').val(workgubun);
            $(this).find('#work_day').val(workdate);
        } else {
            $(this).find('#opt').val('A');
            $(this).find('#work_day').val('2020-08-30');
            $(this).find('.file_upload > .btn_left').remove();
            $(this).find('.file_upload').append('<div class="btn_left"><button class="btn btn-plus" onclick="javascript:document.getElementById(\'file1\').click();">파일첨부</button><span class="file_oriName1"></span><input type="file" id="file1" name="files" style="display: none;"></div>');
        }
        
    });

    $('#msdsManageModal').on('show.bs.modal', function(e){
        let btnEl = $(e.relatedTarget);
        let text = btnEl.html();
        $('#msdsManageModal #msdsManageModalLabel').html('MSDS 데이터 '+ text);
        $('#msdsManageModal .modal-footer .btn-primary').html(text);

        if(text == '수정'){
            let workdate = btnEl.data('workdate');
            let workgubun = btnEl.data('workgubun');
            $(this).find('#opt').val(workgubun);
            $(this).find('#work_day').val(workdate);
        } else {
            $(this).find('#opt').val('A');
            $(this).find('#work_day').val('2020-08-30');
            $(this).find('.file_upload > .btn_left').remove();
            $(this).find('.file_upload').append('<div class="btn_left"><button class="btn btn-plus" onclick="javascript:document.getElementById(\'file1\').click();">파일첨부</button><span class="file_oriName1"></span><input type="file" id="file1" name="files" style="display: none;"></div>');
        }
        
    });

});

function attr_value_remove(idx){
    $('#attr_value_tbody').find('tr:eq('+idx+')').remove();
    $('.pop01').remove();
}

function attr_value_add(){
    let inputValue = $('.pop02').find('input').val(); 
    $('#attr_value_tbody').append('<tr><td>'+inputValue+'</td><td><span class="btn_minus" style="cursor:pointer;"></span></td></tr>')
    $('.pop02').remove();
}

// 토글 버튼 이동 모션 함수
function toggleActionStart(toggleBtn, LR) {
    // 0.01초 단위로 실행
    var intervalID = setInterval(
        function() {
            // 버튼 이동
            var left = parseInt(toggleBtn.css('left'));
            left += (LR == 'TO_RIGHT') ? 5 : -5;
            if(left >= 0 && left <= 40) {
                left += 'px';
                toggleBtn.css('left', left);
            }
        }, 10);
    setTimeout(function(){
        clearInterval(intervalID);
    }, 201);
}

function pwcheck(e){
    let pw = $('#pw').val();
    let pw2 = $('#pwCon').val();
    let pwcheckStr = '';
    let color = '';
    if(pw == '' && pw2 == ''){
        pwcheckStr = '';
        color = 'black';
    } else if(pw == pw2){
        pwcheckStr = ' (일치)';
        color = 'green';
    } else {
        pwcheckStr = '불일치';
        color = 'red';
    }
    $('#pwchecktext').html(pwcheckStr).css('color', color);
}

