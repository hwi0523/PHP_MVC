<div>
    <?php if(isset($_SESSION[_LOGINUSER])) { ?>
        <a href="/board/write">글쓰기</a>
        <a href="/user/logout">로그아웃</a>
    <?php } else { ?>
        <a href="/user/login">로그인</a>
        <a href="/user/join">회원가입</a>
    <?php } ?>
    <a href="/board/list">리스트</a>
</div>