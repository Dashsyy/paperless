$(document).ready(function (e) {
//	$('ul.bullet-red > li:last-child').fadeOut();
//	$(document).on('click', '.nav-tabs li', function(){
//		var index = $(this).index();
//		if(index == 0 || index == 2){
//			$('ul.bullet-red > li:last-child').fadeOut();
//		}else{
//			$('ul.bullet-red > li:last-child').fadeIn();
//		}
//	});
	$('#des-swift').css('display','none');
	$(document).on('click', '.nav-tabs li', function(){
		var index = $(this).index();
		if(index == 0 || index == 2){
			$('#des-exchange').css('display','block');
			$('#des-swift').css('display','none');
		}else{
			$('#des-exchange').css('display','none');
			$('#des-swift').css('display','block');
		}
	});
	var sbfrom = $("#sb_formcurrency").val();
	var sbto = $("#sb_tocurrency").val();
	$.each($('p'), function(index, value){
		var val = $(this).html();
		if(val == ''){
			$(this.remove());
		}
	});
	//$("#sb_tocurrency option[value='"+sbfrom+"']").attr('disabled', 'disabled');
	//$("#sb_formcurrency option[value='"+sbto+"']").attr('disabled', 'disabled');
	$("#fromamount").keydown(function (e) {
		// Allow: backspace, delete, tab, escape, enter and .
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
			// Allow: Ctrl+A, Command+A
			(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
			// Allow: home, end, left, right, down, up
			(e.keyCode >= 35 && e.keyCode <= 40)) {
			// let it happen, don't do anything
			return;
		}
		// Ensure that it is a number and stop the keypress
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}
	});
	var buyRate = 0;
	var sellRate = 0;
	var totalSell = 0;
	var totalBuy = 0;
	$('#fromamount').keyup(function(event) {
		// skip for arrow keys
		if(event.which >= 37 && event.which <= 40) return;
		// format number

		var fromAmount = $(this).val();
		var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
		if(!numericReg.test(fromAmount)) {
			//$(this).val('');
			//return false;
		}
		var changeIn = $('#toamount');
		var from = $('#sb_formcurrency').val();
		var to = $('#sb_tocurrency').val();

		calculationRateFrom(parseFloat(fromAmount), changeIn, from, to);
	});

	$(document).on('change', '#sb_formcurrency', function(){
		var from = $(this).val();
		var to = $('#sb_tocurrency').val();
		$(this).removeAttr('disabled', 'disabled');
		//$("#sb_tocurrency option").removeAttr('disabled', 'disabled');
		//$("#sb_tocurrency option[value='"+from+"']").attr('disabled', 'disabled');
		var fromAmount = $('#fromamount').val();
		var changeIn = $('#toamount');
		if(fromAmount > 0){
			calculationRateFrom(fromAmount, changeIn, from, to);
		}
	});
	$(document).on('change', '#sb_tocurrency', function(){
		var from = $(this).val();
		var to = $('#sb_formcurrency').val();
		$(this).removeAttr('disabled', 'disabled');
		//$("#sb_formcurrency option").removeAttr('disabled', 'disabled');
		//$("#sb_formcurrency option[value='"+from+"']").attr('disabled', 'disabled');
		var fromAmount = $('#fromamount').val();
		var changeIn = $('#toamount');
		if(fromAmount > 0){
			calculationRateFrom(fromAmount, changeIn, to, from);
		}
	});


	/**
	 *
	 * @param amount
	 * @param from
	 * @param to
	 * @param from2
	 * @param to2
	 */

	function showContent(amount, from, to, from2, to2){
		//exchange_content
		if(buyRate > 0 && sellRate > 0){
			$('#exchange_content').fadeIn();
			$('#lfrom_currency').html(from);
			$('#lto_currency').html(to);
			$('.formcal').html(amount + ' ' + from2);
			$('.tocal2').html(to2);
			$('.sformcal').html('1 '+from);
			$('.tocal').html(to);
			totalSellexplode = explode('.', totalSell);
			$('#totalCal').html(number_format(totalSell, 2, '.', ','));

			sellRateexpload = explode('.', sellRate);
			if(strlen(sellRateexpload[0]) > 2){
				$('#stotalCal').html(number_format(sellRate, 2, '.', ','));
			}else{
				firstRound = sellRate.toFixed(6);
				$('#stotalCal').html(number_format(firstRound, 6, '.', ','));
			}

			// Currency VND - KHR = 4 and other = 2
			if(to == 'VND' && from != 'KHR' || from == 'VND' && to != 'KHR'){
				$('#stotalCal').html(number_format(sellRate, 2, '.', ','));
			}else if(to == 'VND' && from == 'KHR' || from == 'VND' && to == 'KHR'){
				$('#stotalCal').html(number_format(sellRate, 4, '.', ','));
			}

			// Currency JPN - KHR = 4 and other = 6
			if(to == 'JPY' && from != 'KHR' || from == 'JPY' && to != 'KHR'){
				$('#stotalCal').html(number_format(sellRate, 6, '.', ','));
			}else if(to == 'JPY' && from == 'KHR' || from == 'JPY' && to == 'KHR'){
				$('#stotalCal').html(number_format(sellRate, 4, '.', ','));
			}

			buyRateexplode = explode('.', buyRate);

			if(strlen(buyRateexplode[0]) > 2){
				$('#btotalCal').html(number_format(buyRate, 2, '.', ','));
			}else{
				firstRound = buyRate.toFixed(6);
				$('#btotalCal').html(number_format(firstRound, 6, '.', ','));
			}
			if(to == 'VND' && from != 'KHR' || from == 'VND' && to != 'KHR'){
				$('#btotalCal').html(number_format(buyRate, 2, '.', ','));
			}else if(to == 'VND' && from == 'KHR' || from == 'VND' && to == 'KHR'){
				$('#btotalCal').html(number_format(buyRate, 4, '.', ','));
			}

			if(to == 'JPY' && from != 'KHR' || from == 'JPY' && to != 'KHR'){
				$('#btotalCal').html(number_format(buyRate, 6, '.', ','));
			}else if(to == 'JPY' && from == 'KHR' || from == 'JPY' && to == 'KHR'){
				$('#btotalCal').html(number_format(buyRate, 4, '.', ','));
			}
		}
	}
	var sell1 = null;
	var buy1 = null;
	function calculationRateFrom(fromAmount, changeIn, from, to) {
		//Value of $rateData
		var rate = $.parseJSON($('#exchangeData').val());//console.log('Note rate: ' + rate);
		var fromRate = 0;
		var toRate = 0;

		if(rate.length > 0){
			$.each(rate , function (index, value) {
				if(from.toLowerCase() == to.toLowerCase()){
					totalSell = parseFloat(fromAmount+'.00');
					totalBuy = parseFloat(fromAmount+'.00');
					buyRate = value.unit;
					sellRate = value.unit;
					changeIn.val(totalSell+'.00');
					showContent(fromAmount, from, to, from, to);
					return false;
				}else if(to.toLowerCase() == 'khr'){
					if(value.from.toLowerCase() == from.toLowerCase()){
						var buy = parseFloat(value.buy)/value.unit;
						totalSell = buy * fromAmount;
						totalBuy = (parseFloat(value.buy)/value.unit) * fromAmount;
						buyRate = value.buy/value.unit;
						sellRate = value.sell/value.unit;
						totalSellexplode = explode('.', totalSell);
						changeIn.val(number_format(totalSell, 2, '.', ','));
						showContent(fromAmount, from, to, from, to);
						return false;
					}
				}else if(from.toLowerCase() == 'khr'){
					if(to.toLowerCase() == value.from.toLowerCase()){
						fromRate = parseFloat(value.sell)/value.unit;
						toRate = parseFloat(value.buy)/value.unit;
						buyRate = value.buy/value.unit;
						sellRate = value.sell/value.unit;
						totalBuy = fromAmount;
						totalSell = (1/fromRate) * fromAmount;
						totalSellexplode = explode('.', totalSell);
						changeIn.val(number_format(totalSell, 2, '.', ','));
						showContent(fromAmount, to, from, from, to);
						return false;
					}
				}else{
					if(from.toLowerCase() == value.from.toLowerCase()){
						fromRate = parseFloat(value.buy)/value.unit;
						buyRate = value.sell/value.unit;
						buy1 = value;
					}
					if(to.toLowerCase() == value.from.toLowerCase()){
						toRate = parseFloat(value.sell)/value.unit;
						sellRate = value.buy/value.unit;
						sell1 = value;
					}

					if (fromRate > 0 && toRate > 0) {
						if(to.toLowerCase() == 'usd'){
							totalSell = (fromRate / toRate) * fromAmount;

							totalSellexplode = explode('.', totalSell);

							if (strlen(totalSellexplode[0]) > 2) {
								changeIn.val(number_format(totalSell, 2, '.', ','));
							} else {
								firstRound = totalSell.toFixed(5)+'1';
								changeIn.val(number_format(firstRound, 2, '.', ','));
							}

							if(from == 'AUD' || from == 'EUR' || from == 'GBP'){
								sellRate = (parseFloat(buy1.sell)/buy1.unit) / (parseFloat(sell1.buy)/sell1.unit);
								buyRate = (fromRate / toRate);
								showContent(fromAmount, from, to, from, to);
							}else{
								sellRate = (sell1.sell/sell1.unit)/(buy1.buy/buy1.unit);
								buyRate = (sell1.buy/sell1.unit)/(buy1.sell/buy1.unit);
								showContent(fromAmount, to, from, from, to);
							}

						}else{
							sellRate = (buy1.sell/buy1.unit) / (sell1.buy/sell1.unit);
							buyRate = (buy1.buy/buy1.unit) / (sell1.sell/sell1.unit);

							totalSell = (fromRate / toRate) * fromAmount;
							totalSellexplode = explode('.', totalSell);
							if (strlen(totalSellexplode[0]) > 2) {
								changeIn.val(number_format(totalSell, 2, '.', ','));
							} else {
								firstRound = totalSell.toFixed(6);
								changeIn.val(number_format(firstRound, 2, '.', ','));
							}
							if(to == 'AUD' || to == 'EUR' || to == 'GBP'){
								if (from.toLowerCase() == 'usd') {
									sellRate = (toRate / fromRate);
									buyRate = (sell1.buy/sell1.unit) / (buy1.sell/buy1.unit);
									showContent(fromAmount, to, from, from, to);
								} else {
									showContent(fromAmount, from, to, from, to);
								}
							} else {
								showContent(fromAmount, from, to, from, to);
							}
						}
						return false;
					}
				}

			});
		}
	}

	/**
	 * Commercial Telegraphic
	 */
	var ttBuyRate = 0;
	var ttSellRate = 0;
	var ttTotalSell = 0;
	var ttTotalBuy = 0;
	$('#tt_fromAmount').keyup(function(event) {
		// skip for arrow keys
		if(event.which >= 37 && event.which <= 40) return;
		// format number

		var fromAmount = $(this).val();
		var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
		if(!numericReg.test(fromAmount)) {
			//$(this).val('');
			//return false;
		}
		var changeIn = $('#tt_toAmount');
		var from = $('#com_formcurrency').val();
		var to = $('#com_toCurrency').val();

		ttCalculationRateFrom(parseFloat(fromAmount), changeIn, from, to);
	});

	$(document).on('change', '#com_formcurrency', function(){
		var ttFrom = $(this).val();
		var ttTo = $('#com_toCurrency').val();
		$(this).removeAttr('disabled', 'disabled');
		var ttFromAmount = $('#tt_fromAmount').val();
		var ttChangeIn = $('#tt_toAmount');
		if(ttFromAmount > 0){
			ttCalculationRateFrom(ttFromAmount, ttChangeIn, ttFrom, ttTo);
		}
	});
	$(document).on('change', '#com_toCurrency', function(){
		var ttFrom = $(this).val();
		var ttTo = $('#com_formcurrency').val();
		$(this).removeAttr('disabled', 'disabled');
		var ttFromAmount = $('#tt_fromAmount').val();
		var ttChangeIn = $('#tt_toAmount');
		if(ttFromAmount > 0){
			ttCalculationRateFrom(ttFromAmount, ttChangeIn, ttTo, ttFrom);
		}
	});
	/**
	 * End Implement
	 */

	/**
	 * Commercial function
	 */
	function ttShowContent(amount, from, to, from2, to2){
		//exchange_content
		if(ttBuyRate > 0 && ttSellRate > 0){
			$('#tt_exchange_content').fadeIn();
			$('#lfrom_currency').html(from);
			$('#lto_currency').html(to);
			$('.ttformcal').html(amount + ' ' + from2);
			$('.ttTocal2').html(to2);
			$('.ttSformcal').html('1 '+ from);
			$('.tt_Tocal').html(to);
			totalSellexplode = explode('.', ttTotalSell);
			$('#tt_totalCal').html(number_format(ttTotalSell, 2, '.', ','));

			sellRateexpload = explode('.', ttSellRate);
			if(strlen(sellRateexpload[0]) > 2){
				$('#ttStotalCal').html(number_format(ttSellRate, 2, '.', ','));
			}else{
				firstRound = ttSellRate.toFixed(6);
				$('#ttStotalCal').html(number_format(firstRound, 6, '.', ','));
			}

			// Currency VND - KHR = 4 and other = 2
			if(to == 'VND' && from != 'KHR' || from == 'VND' && to != 'KHR'){
				$('#ttStotalCal').html(number_format(ttSellRate, 2, '.', ','));
			}else if(to == 'VND' && from == 'KHR' || from == 'VND' && to == 'KHR'){
				$('#ttStotalCal').html(number_format(ttSellRate, 4, '.', ','));
			}

			// Currency JPN - KHR = 4 and other = 6
			// if(to == 'JPY' && from != 'KHR' || from == 'JPY' && to != 'KHR'){
			// 	$('#ttStotalCal').html(number_format(ttSellRate, 6, '.', ','));
			// }else if(to == 'JPY' && from == 'KHR' || from == 'JPY' && to == 'KHR'){
			// 	$('#ttStotalCal').html(number_format(ttSellRate, 4, '.', ','));
			// }

			buyRateexplode = explode('.', ttBuyRate);

			if(strlen(buyRateexplode[0]) > 2){
				$('#ttBtotalCal').html(number_format(ttBuyRate, 2, '.', ','));
			}else{
				firstRound = ttBuyRate.toFixed(6);
				$('#ttBtotalCal').html(number_format(firstRound, 6, '.', ','));
			}
			if(to == 'VND' && from != 'KHR' || from == 'VND' && to != 'KHR'){
				$('#btotalCal').html(number_format(ttBuyRate, 2, '.', ','));
			}else if(to == 'VND' && from == 'KHR' || from == 'VND' && to == 'KHR'){
				$('#ttBtotalCal').html(number_format(ttBuyRate, 4, '.', ','));
			}

			// if(to == 'JPY' && from != 'KHR' || from == 'JPY' && to != 'KHR'){
			// 	$('#ttBtotalCal').html(number_format(ttBuyRate, 6, '.', ','));
			// }else if(to == 'JPY' && from == 'KHR' || from == 'JPY' && to == 'KHR'){
			// 	$('#ttBtotalCal').html(number_format(ttBuyRate, 4, '.', ','));
			// }
		}
	}

	var sell2 = null;
	var buy2 = null;
	function ttCalculationRateFrom(fromAmount, changeIn, from, to) {
		//Value of $rateData
		var ttRate = $.parseJSON($('#comexchangeData').val());
	//	console.log(ttRate);
		var ttFromRate = 0;
		var ttToRate = 0;
		if(ttRate.length > 0){
			$.each(ttRate , function (index, value) {
				if(from.toLowerCase() == to.toLowerCase()){
					ttTotalSell = parseFloat(fromAmount+'.00');
					totalBuy = parseFloat(fromAmount+'.00');
					// buyRate = value.unit;
					// sellRate = value.unit;
					ttBuyRate = value.buy/value.unit;
					ttSellRate = value.sell/value.unit;
					changeIn.val(totalSell+'.00');
					ttShowContent(fromAmount, from, to, from, to);
					return false;
				}else if(to.toLowerCase() == 'khr') {
					if(value.from.toLowerCase() == from.toLowerCase()){
						var sell = parseFloat(value.sell)/value.unit;
						ttTotalSell = sell * fromAmount;
						ttTotalBuy = (parseFloat(value.sell)/value.unit) * fromAmount;
						ttBuyRate = value.buy/value.unit;
						ttSellRate = value.sell/value.unit;
						totalSellexplode = explode('.', ttTotalSell);
						changeIn.val(number_format(ttTotalSell, 2, '.', ','));
						ttShowContent(fromAmount, from, to, from, to);
						return false;
					}
				} else{

					// console.log('Total Convert from '+ from.toLowerCase() +' to '+ to.toLowerCase() +' :'+ parseFloat(value.sell)+ '/'+ value.unit + '*' + fromAmount+ '=' + totalBuy);
					if(from.toLowerCase() == value.from.toLowerCase()){
						ttFromRate = parseFloat(value.buy)/value.unit;
						ttBuyRate = value.sell/value.unit;
						buy2 = value;
					}
					if(to.toLowerCase() == value.from.toLowerCase()){
						ttToRate = parseFloat(value.sell)/value.unit;
						ttSellRate = value.buy/value.unit;
						sell2 = value;
					}

					if (ttFromRate > 0 && ttToRate > 0) {
						if(to.toLowerCase() == 'usd'){
							ttTotalSell = (ttFromRate / ttToRate) * fromAmount;

							totalSellexplode = explode('.', totalSell);

							if (strlen(totalSellexplode[0]) > 2) {
								changeIn.val(number_format(ttTotalSell, 2, '.', ','));
								ttShowContent(fromAmount, from, to, from, to);
							} else {
								firstRound = ttTotalSell.toFixed(5)+'1';
								changeIn.val(number_format(firstRound, 2, '.', ','));
								ttShowContent(fromAmount, from, to, from, to);
							}

							if(from == 'AUD' || from == 'EUR' || from == 'GBP'){
								ttSellRate = (parseFloat(buy2.sell)/buy2.unit) / (parseFloat(sell2.buy)/sell2.unit);
								ttBuyRate = (ttFromRate / ttToRate);
								ttTotalSell = ttSellRate * fromAmount;

								totalSellexplode = explode('.', ttTotalSell);
								changeIn.val(number_format(ttTotalSell, 2, '.', ','));
								ttShowContent(fromAmount, from, to, from, to);
							}
							else{
								ttSellRate = (ttToRate / ttFromRate);
								ttBuyRate = (parseFloat(sell2.buy)/sell2.unit) / (parseFloat(buy2.sell)/buy2.unit);
								ttTotalSell =  fromAmount / ttBuyRate;
								totalSellexplode = explode('.', ttTotalSell);
								changeIn.val(number_format(ttTotalSell, 2, '.', ','));
								ttShowContent(fromAmount, to, from, from, to);
							}
						}
						return false;
					}
				}
			});
		}
	}

});

function strlen (string) {
	//  discuss at: http://locutus.io/php/strlen/
	// original by: Kevin van Zonneveld (http://kvz.io)
	// improved by: Sakimori
	// improved by: Kevin van Zonneveld (http://kvz.io)
	//    input by: Kirk Strobeck
	// bugfixed by: Onno Marsman (https://twitter.com/onnomarsman)
	//  revised by: Brett Zamir (http://brett-zamir.me)
	//      note 1: May look like overkill, but in order to be truly faithful to handling all Unicode
	//      note 1: characters and to this function in PHP which does not count the number of bytes
	//      note 1: but counts the number of characters, something like this is really necessary.
	//   example 1: strlen('Kevin van Zonneveld')
	//   returns 1: 19
	//   example 2: ini_set('unicode.semantics', 'on')
	//   example 2: strlen('A\ud87e\udc04Z')
	//   returns 2: 3
	var str = string + ''
	var iniVal = (typeof require !== 'undefined' ? require('../info/ini_get')('unicode.semantics') : undefined) || 'off'
	if (iniVal === 'off') {
		return str.length
	}
	var i = 0
	var lgth = 0
	var getWholeChar = function (str, i) {
		var code = str.charCodeAt(i)
		var next = ''
		var prev = ''
		if (code >= 0xD800 && code <= 0xDBFF) {
			// High surrogate (could change last hex to 0xDB7F to
			// treat high private surrogates as single characters)
			if (str.length <= (i + 1)) {
				throw new Error('High surrogate without following low surrogate')
			}
			next = str.charCodeAt(i + 1)
			if (next < 0xDC00 || next > 0xDFFF) {
				throw new Error('High surrogate without following low surrogate')
			}
			return str.charAt(i) + str.charAt(i + 1)
		} else if (code >= 0xDC00 && code <= 0xDFFF) {
			// Low surrogate
			if (i === 0) {
				throw new Error('Low surrogate without preceding high surrogate')
			}
			prev = str.charCodeAt(i - 1)
			if (prev < 0xD800 || prev > 0xDBFF) {
				// (could change last hex to 0xDB7F to treat high private surrogates
				// as single characters)
				throw new Error('Low surrogate without preceding high surrogate')
			}
			// We can pass over low surrogates now as the second
			// component in a pair which we have already processed
			return false
		}
		return str.charAt(i)
	}
	for (i = 0, lgth = 0; i < str.length; i++) {
		if ((getWholeChar(str, i)) === false) {
			continue
		}
		// Adapt this line at the top of any loop, passing in the whole string and
		// the current iteration and returning a variable to represent the individual character;
		// purpose is to treat the first part of a surrogate pair as the whole character and then
		// ignore the second part
		lgth++
	}
	return lgth
}
function explode (delimiter, string, limit) {
	//  discuss at: http://locutus.io/php/explode/
	// original by: Kevin van Zonneveld (http://kvz.io)
	//   example 1: explode(' ', 'Kevin van Zonneveld')
	//   returns 1: [ 'Kevin', 'van', 'Zonneveld' ]
	if (arguments.length < 2 ||
		typeof delimiter === 'undefined' ||
		typeof string === 'undefined') {
		return null
	}
	if (delimiter === '' ||
		delimiter === false ||
		delimiter === null) {
		return false
	}
	if (typeof delimiter === 'function' ||
		typeof delimiter === 'object' ||
		typeof string === 'function' ||
		typeof string === 'object') {
		return {
			0: ''
		}
	}
	if (delimiter === true) {
		delimiter = '1'
	}
	// Here we go...
	delimiter += ''
	string += ''
	var s = string.split(delimiter)
	if (typeof limit === 'undefined') return s
	// Support for limit
	if (limit === 0) limit = 1
	// Positive limit
	if (limit > 0) {
		if (limit >= s.length) {
			return s
		}
		return s
			.slice(0, limit - 1)
			.concat([s.slice(limit - 1)
				.join(delimiter)
			])
	}
	// Negative limit
	if (-limit >= s.length) {
		return []
	}
	s.splice(s.length + limit)
	return s
}

function number_format (number, decimals, decPoint, thousandsSep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
	var n = !isFinite(+number) ? 0 : +number
	var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
	var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
	var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
	var s = ''

	var toFixedFix = function (n, prec) {
		var k = Math.pow(10, prec)
		return '' + (Math.round(n * k) / k)
			.toFixed(prec)
	}

	// @todo: for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || ''
		s[1] += new Array(prec - s[1].length + 1).join('0')
	}

	return s.join(dec)
}
