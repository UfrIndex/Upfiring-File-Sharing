let elem = document.getElementById("content-block");
if (m_t_block === undefined) {
    var m_t_block = '0';
}
function createMessageUnder(elem) {
    let coords = elem.getBoundingClientRect();
    let left_block = document.querySelector(".left-block");
    let right_block = document.querySelector(".right-block");
    let banner_left_block = document.getElementById("left-block-bnr");
    let banner_right_block = document.getElementById("right-block-bnr");
    let content_block = document.getElementById('content');
    change_status_banner(content_block, left_block, banner_left_block, coords);
    change_status_banner(content_block, right_block, banner_right_block, coords);

}

function change_status_banner(content, banner, banner_block, coords) {
    if (coords.top < m_t_block && document.body.clientWidth >= 1200 ) {
        if(banner_block.getBoundingClientRect().bottom + m_t_block < content.getBoundingClientRect().bottom || content.getBoundingClientRect().bottom - m_t_block > banner_block.getBoundingClientRect().height ){
            banner.style.cssText = "";
            banner_block.style.cssText = "position: fixed;top: " + m_t_block + "px;";
        }
        else{
            banner.style.cssText = "justify-content: flex-end;";
            banner_block.style.cssText = "position: relative;";
        }
    }
    else {
        banner.style.cssText = "";
        banner_block.style.cssText = "position: relative;";
    }
}

window.addEventListener('scroll', function(e) {
    createMessageUnder(elem);
});
