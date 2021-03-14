<script>
    function showMenu(){
        var menu = document.getElementById('menu');
        menu.classList.add('active');
    }

    function hideMenu(){
        var menu = document.getElementById('menu');
        menu.classList.remove('active');
    }

    function sliderAutoPlay(){
        sliderShowItem();
        setInterval(function(){
            sliderShowItem();
        }, 5000);
    }

    function sliderNextItem() {
        sliderShowItem();
    }

    function sliderShowItem() {
        console.log('slide move');
        var slider = document.getElementsByClassName("slider");

        if(slider.length){
            for (i = 0; i < slider.length; i++) {
                var items = slider[i].getElementsByClassName('item');
                var index = slider[i].getAttribute('active-index');

                if(parseInt(index) == (items.length - 1)){
                    slider[i].removeAttribute('active-index');
                    index = 0;
                }

                if(!index){
                    index = 0;
                    slider[i].setAttribute('active-index', 0);
                }else{
                    index =  parseInt(index) + 1;
                    slider[i].setAttribute('active-index', index);
                }

                if(items.length){
                    for (j = 0; j < items.length; j++) {
                        var item = items[j];

                        item.classList.remove('active');

                        if((j == index)){
                            item.classList.add('active');
                        }
                    }
                }
            }
        }
    }
</script>

{{-- init script --}}
<script>
    sliderAutoPlay();
</script>
{{-- end init script --}}
