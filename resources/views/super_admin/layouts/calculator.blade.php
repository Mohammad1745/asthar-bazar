
<!-- ****************
  After neccessary customization/modification, Please minify
  JavaScript/jQuery according to http://browserdiet.com/en/ for better performance
**************** -->
<!-- STYLE SWITCH STYLESHEET ONLY FOR DEMO -->
<link rel="stylesheet" href="{{asset('assets/plugins/calculator/calculator.css')}}">
<script type="text/javascript" src="{{asset('assets/plugins/calculator/calculator.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/calculator/content-switcher.js')}}"></script>
<div class="calculator-switch" id="switch-content">
    <a id="toggle-switcher" title="Calculator" class="switch-button"><i class="fa fa-calculator"></i></a>
    <div class="switched-options">
        <p class="warning">Don't divide by zero</p>

        <div id="calculator" class="calculator">

            <button id="clear" class="calc-key clear">C</button>

            <div id="symbol-viewer" class="symbol-viewer"></div>
            <div id="viewer" class="viewer">0</div>

            <button class="calc-key num" data-num="7">7</button>
            <button class="calc-key num" data-num="8">8</button>
            <button class="calc-key num" data-num="9">9</button>
            <button data-ops="plus" class="calc-key ops">+</button>

            <button class="calc-key num" data-num="4">4</button>
            <button class="calc-key num" data-num="5">5</button>
            <button class="calc-key num" data-num="6">6</button>
            <button data-ops="minus" class="calc-key ops">-</button>

            <button class="calc-key num" data-num="1">1</button>
            <button class="calc-key num" data-num="2">2</button>
            <button class="calc-key num" data-num="3">3</button>
            <button data-ops="times" class="calc-key ops">*</button>

            <button class="calc-key num" data-num="0">0</button>
            <button class="calc-key num" data-num=".">.</button>
            <button id="equals" class="calc-key equals" data-result="">=</button>
            <button data-ops="divided by" class="calc-key ops">/</button>
        </div>

        <button id="reset" class="calc-key reset">Reset Universe?</button>
    </div>
</div>
