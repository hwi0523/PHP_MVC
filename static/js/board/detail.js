(function () {

    const Del = document.querySelector("#btnDel");

    Del.addEventListener('click', (e) => {
        if(confirm('삭제하시겠습니까?')){
            location.href = `del?i_board=${e.target.dataset.i_board}`;
        }
    });
})();