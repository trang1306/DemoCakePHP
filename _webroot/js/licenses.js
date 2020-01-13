(function( $ ) {
	$.fn.licensesPlugin = function() { 
		var selectLicenses = this;
		selectLicenses.find('option').each(function(e) {
			$(this).bind('change', function(){
				var type = $(this).attr('data-app_type');
				var quantity = $(this).attr('data-quantity');
				var selected = $(this).attr('selected');
				var installed = $(this).attr('data-installed');
				var purchase_date = $(this).attr('data-purchase_date');
				var now = $(this).attr('data-now');
				now = new Date(now);
				now.setHours(0, 0, 0, 0);
				if (purchase_date) {
					purchase_date = new Date(purchase_date);
					purchase_date.setHours(0, 0, 0, 0);
					var same = now.getTime() > purchase_date.getTime();
				}
				//console.log(now);
				//console.log(purchase_date);
				
				if (type == 'pre-installed-license') { // never limit

				} else if (type == 'cpu-license') { // limit by quantity
					if (!selected && quantity <= installed) {
						$(this).prop('disabled', true);
					}
				} else if (type == 'user-fixed-license') { //limit by quantity and end date

					if (!selected && quantity <= installed) {
						//console.log(quantity);
						$(this).prop('disabled', true);
					}
					var duration =$(this).attr('data-duration');
					if (purchase_date && duration) {
						var limit_date = purchase_date;
						limit_date.setFullYear(limit_date.getFullYear() + parseInt(duration));
						
						var gt = now.getTime() > limit_date.getTime();
						//console.log(gt);
						if (gt) {
							$(this).prop('disabled', true);
						}
					}
				} else if (type == 'package-license') { //limit by quantity and disposal date
					if (!selected && quantity <= installed) {
						$(this).prop('disabled', true);
					}
					var disposal_flag =$(this).attr('data-disposal_flag');
					var disposal_date =$(this).attr('data-disposal_date');
					if (disposal_date && disposal_flag) {
						disposal_date = new Date(disposal_date);
						disposal_date.setHours(0, 0, 0, 0);
						var gt = now.getTime() > disposal_date.getTime();
						if (gt) {
							$(this).prop('disabled', true);
						}
					}
				} else if (type == 'shareware') { //limit by quantity and disposal date
					if (!selected && quantity <= installed) {
						$(this).prop('disabled', true);
					}
					var disposal_flag =$(this).attr('data-disposal_flag');
					var disposal_date =$(this).attr('data-disposal_date');
					if (disposal_date && disposal_flag) {
						disposal_date = new Date(disposal_date);
						disposal_date.setHours(0, 0, 0, 0);
						var gt = now.getTime() > disposal_date.getTime();
						if (gt) {
							$(this).prop('disabled', true);
						}
					}
				} else if (type == 'freeware') { // limit by PROHIBITION_DATE date
					var prohibition_flag =$(this).attr('data-prohibition_flag');
					var prohibition_date =$(this).attr('data-prohibition_date');
					if (prohibition_date && prohibition_flag) {
						prohibition_date = new Date(prohibition_date);
						prohibition_date.setHours(0, 0, 0, 0);
						var gt = now.getTime() > prohibition_date.getTime();
						if (gt) {
							$(this).prop('disabled', true);
						}
					}
				} else { //software-developed-in-house: never limit
					
				}
			})
			//console.log(type);
		})
		$(selectLicenses).find('option').trigger('change');
		selectLicenses.select2({
			matcher: matchLicenses,
			templateResult: formatLicenses,
			templateSelection: formatSelectionFullLicenses,
			theme: "as"
        });
		// this.on('change', function (e) {
		//     //var data = e.params.data;
		//     console.log(e);
		// });
		selectLicenses.on('select2:select', function (e) {
		    var option = e.params.data.element;
		    console.log(e.params.data);
		    var installed = $(option).attr('data-installed');
		    if (!installed) {
		    	installed = 0;
		    }
		    $(option).attr('data-installed', parseInt(installed) + 1);

		    selectLicenses.trigger('change.select2');
		});
		selectLicenses.on('select2:unselect', function (e) {
		    var option = e.params.data.element;
		    var installed = $(option).attr('data-installed');
		    if (!installed) {
		    	installed = 0;
		    }
		    $(option).attr('data-installed', parseInt(installed) - 1);
		    selectLicenses.trigger('change.select2');
		});
		return this;
	};
}(jQuery));
function stringMatch(term, candidate) {
    var re = candidate && term &&  candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
    return re;
}
function matchLicenses(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }
    // // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
        return null;
    }
    // // Match text of option
    if (stringMatch(params.term, data.text)) {
        return data;
    }
    // // Match attribute "data-code" of option
    if (stringMatch(params.term, $(data.element).attr('data-name'))) {
        return data;
    }
    // // Match attribute "data-address" of option
    if (stringMatch(params.term, $(data.element).attr('data-version'))) {
        return data;
    }
    // // Match attribute "data-phone1" of option
    if (stringMatch(params.term, $(data.element).attr('data-product_key'))) {
        return data;
    }
    // // Match attribute "data-phone2" of option
    if (stringMatch(params.term, $(data.element).attr('data-serial_number'))) {
        return data;
    }
    // // Match attribute "data-curator" of option
    // if (stringMatch(params.term, $(data.element).attr('data-curator'))) {
    //     return data;
    // }
    // Return `null` if the term should not be displayed
    return null;
}
function formatLicenses(state) {
    var divParent = $('<div></div>');
    if (state.disabled) {
    	divParent = $('<div class="text-muted"></div>');
    }
    if (!$(state.element).attr('data-name')) { // o
    	return $('<h4 class="text-uppercase">'+state.text+'</h4>')
    }
    firstRow = $('<div><span class="badge badge-success">'+$(state.element).attr('data-name')+'</span> </div>');
    if ($(state.element).attr('data-version')) {
    	firstRow = $('<div><span class="badge badge-success">'+$(state.element).attr('data-name')+' - ' + $(state.element).attr('data-version') +'</span> </div>');
    }
    firstRow.append('<i class="float-right text-success">'+$(state.element).attr('data-maker_name')+'</i>');
    secondRow = null;
    thirdRow = null;
    var type = $(state.element).attr('data-app_type');
	var quantity = $(state.element).attr('data-quantity');
	var installed = $(state.element).attr('data-installed');

	//indiv = $('<div class=""></div>');
    
    if (type == 'pre-installed-license') { // never limit
    	secondRow = $('<div></div>');
    	
		firstRow.append('<i><strong>キー:</strong> '+ $(state.element).attr('data-product_key')+' </i>');
    	secondRow = $('<div>インストール済み: '+installed+'</div>');
    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
    	
	} else if (type == 'cpu-license') { // limit by quantity
		secondRow = $('<div></div>');
		firstRow.append('<i><strong>キー:</strong> '+ $(state.element).attr('data-product_key')+' </i>');
		secondRow.append('<strong>本数:</strong> '+ $(state.element).attr('data-quantity')+'&nbsp; &nbsp; &nbsp; ');
		secondRow.append('<strong>購入日:</strong> '+ $(state.element).attr('data-purchase_date')+' &nbsp; &nbsp; &nbsp;');
		secondRow.append('<strong>インストール済み:</strong> '+ $(state.element).attr('data-installed') +' &nbsp; &nbsp; &nbsp;');
		available = parseInt($(state.element).attr('data-quantity')) - parseInt($(state.element).attr('data-installed'));
    	secondRow.append('<strong>利用可能:</strong> '+ available +'');
    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
	} else if (type == 'user-fixed-license') { //limit by quantity and end date
		secondRow = $('<div></div>');
		firstRow.append('<i><strong>キー:</strong> '+ $(state.element).attr('data-product_key')+' </i>');
		secondRow.append('<strong>購入日:</strong> '+ $(state.element).attr('data-purchase_date')+' &nbsp; &nbsp; &nbsp;');
		secondRow.append('<strong>期間:</strong> '+ $(state.element).attr('data-duration')+'&nbsp; &nbsp; &nbsp; ');
		
		secondRow.append('<strong>インストール済み:</strong> '+ $(state.element).attr('data-installed') + '/' + $(state.element).attr('data-quantity') +' &nbsp; &nbsp; &nbsp;');
		available = parseInt($(state.element).attr('data-quantity')) - parseInt($(state.element).attr('data-installed'));
    	secondRow.append('<strong>利用可能:</strong> '+ available +' &nbsp; &nbsp; &nbsp;');

    	secondRow.append('<strong>ID:</strong> '+ $(state.element).attr('data-username') +' &nbsp; &nbsp; &nbsp;');
    	secondRow.append('<strong>パスワード:</strong> '+ $(state.element).attr('data-password') +'');

    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
	} else if (type == 'package-license') { //limit by quantity and disposal date
		secondRow = $('<div></div>');
		firstRow.append('<i><strong>シリアル番号:</strong> '+ $(state.element).attr('data-serial_number')+' </i>');
		secondRow.append('<strong>購入日:</strong> '+ $(state.element).attr('data-purchase_date')+' &nbsp; &nbsp; &nbsp;');
		secondRow.append('<strong>期間:</strong> '+ $(state.element).attr('data-duration')+'&nbsp; &nbsp; &nbsp; ');
		
		secondRow.append('<strong>インストール済み:</strong> '+ $(state.element).attr('data-installed') +' &nbsp; &nbsp; &nbsp;');
		available = parseInt($(state.element).attr('data-quantity')) - parseInt($(state.element).attr('data-installed'));
    	secondRow.append('<strong>利用可能:</strong> '+ available +'');
    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
    	if ($(state.element).attr('data-disposal_flag')) {
    		thirdRow = $('<div></div>');
    		thirdRow.append('<strong>廃棄日:</strong> '+ $(state.element).attr('data-disposal_date') +' &nbsp; &nbsp; &nbsp;');
    	}
	} else if (type == 'shareware') { //limit by quantity and disposal date
		secondRow = $('<div></div>');
		//firstRow.append('<i><strong>Serial:</strong> '+ $(state.element).attr('data-serial_number')+' </i>');
		secondRow.append('<strong>購入日:</strong> '+ $(state.element).attr('data-purchase_date')+' &nbsp; &nbsp; &nbsp;');
		secondRow.append('<strong>本数:</strong> '+ $(state.element).attr('data-quantity')+'&nbsp; &nbsp; &nbsp; ');
		
		secondRow.append('<strong>インストール済み:</strong> '+ $(state.element).attr('data-installed') +' &nbsp; &nbsp; &nbsp;');
		available = parseInt($(state.element).attr('data-quantity')) - parseInt($(state.element).attr('data-installed'));
    	secondRow.append('<strong>利用可能:</strong> '+ available +'');
    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
    	thirdRow = $('<div></div>');
    	company = $('<span class="glyphicon glyphicon-asterisk"></span> <i> '+$(state.element).attr('data-company')+' </i>');
    	thirdRow.append(company);
    	division = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-division')+' </i>');
    	thirdRow.append(division);
    	departement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-department')+' </i>');
    	thirdRow.append(departement);
    	if ($(state.element).attr('data-odepartment')) {
	        odepartement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-odepartment')+' </i>');
	        thirdRow.append(odepartement);
	    }
    	if ($(state.element).attr('data-disposal_flag')) {
    		thirdRow.append('<strong>廃棄日:</strong> '+ $(state.element).attr('data-disposal_date') +' &nbsp; &nbsp; &nbsp;');
    	}
	} else if (type == 'freeware') { // limit by PROHIBITION_DATE date
		secondRow = $('<div></div>');
		//firstRow.append('<i><strong>Serial:</strong> '+ $(state.element).attr('data-serial_number')+' </i>');
		secondRow.append('<strong>購入日:</strong> '+ $(state.element).attr('data-purchase_date')+' &nbsp; &nbsp; &nbsp;');
		//secondRow.append('<strong>Quantity:</strong> '+ $(state.element).attr('data-quantity')+'&nbsp; &nbsp; &nbsp; ');
		
		secondRow.append('<strong>インストール済み:</strong> '+ $(state.element).attr('data-installed') +' &nbsp; &nbsp; &nbsp;');
		// available = $(state.element).attr('data-quantity') - $(state.element).attr('data-installed');
  //   	secondRow.append('<strong>Available:</strong> '+ available +'');
    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
    	thirdRow = $('<div></div>');
    	company = $('<span class="glyphicon glyphicon-asterisk"></span> <i> '+$(state.element).attr('data-company')+' </i>');
    	thirdRow.append(company);
    	division = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-division')+' </i>');
    	thirdRow.append(division);
    	departement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-department')+' </i>');
    	thirdRow.append(departement);
    	if ($(state.element).attr('data-odepartment')) {
	        odepartement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-odepartment')+' </i>');
	        thirdRow.append(odepartement);
	    }
    	if ($(state.element).attr('data-prohibition_flag')) {
    		thirdRow.append('<div><strong>Drohibition date:</strong> '+ $(state.element).attr('data-prohibition_date') +' &nbsp; &nbsp; &nbsp;</div>');
    	}
	} else { //software-developed-in-house: never limit
		firstRow = $('<div><span class="badge badge-warning">'+$(state.element).attr('data-name')+'</span> </div>');
	    if ($(state.element).attr('data-version')) {
	    	firstRow = $('<div><span class="badge badge-warning">'+$(state.element).attr('data-name')+' - ' + $(state.element).attr('data-version') +'</span> </div>');
	    }
	    firstRow.append('<i class="float-right text-success">'+$(state.element).attr('data-maker_name')+'</i>');
	    firstRow.append('<i><strong>作成者:</strong> '+ $(state.element).attr('data-curator')+' &nbsp; &nbsp; &nbsp; </i>');
	    firstRow.append('<i><strong>インストール済み:</strong> '+ installed+' &nbsp; &nbsp; &nbsp; </i>');
	    firstRow.append('<i><strong>月額利用料:</strong> '+ $(state.element).attr('data-fee_month')+'&#165; </i>');
	    secondRow = $('<div></div>');
	    if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
	    if ($(state.element).attr('data-database_info')) {
	    	secondRow.append('<div><strong>利用データベース情報:</strong> '+$(state.element).attr('data-database_info')+'</div>');
	    }
	    if ($(state.element).attr('data-firewall_info')) {
	    	secondRow.append('<div><strong>Firewall情報:</strong> '+$(state.element).attr('data-firewall_info')+'</div>');
	    }
	    if ($(state.element).attr('data-login_id') && $(state.element).attr('data-login_pass')) {
	    	secondRow.append('<div><strong>ログインID:</strong> '+$(state.element).attr('data-login_id')+'&nbsp; &nbsp; &nbsp; <strong>Login Pass:</strong> ' +$(state.element).attr('data-login_pass')+ '</div>');
	    }
		//
	}
    //console.log(state)

    divParent.append(firstRow);
    divParent.append(secondRow);
    divParent.append(thirdRow);

    return divParent;
}
function formatSelectionFullLicenses (state) {
    if (!state.id) {
        return state.text;
    }
    var divParent = $('<div></div>');
    if (state.disabled) {
    	divParent = $('<div class="text-muted"></div>');
    }
    if (!$(state.element).attr('data-name')) { // o
    	return $('<h4 class="text-uppercase">'+state.text+'</h4>')
    }
    firstRow = $('<div><span class="badge badge-success">'+$(state.element).attr('data-name')+'</span> </div>');
    if ($(state.element).attr('data-version')) {
    	firstRow = $('<div><span class="badge badge-success">'+$(state.element).attr('data-name')+' - ' + $(state.element).attr('data-version') +'</span> </div>');
    }
    firstRow.append('<i class="float-right text-success">'+$(state.element).attr('data-maker_name')+'</i>');
    secondRow = null;
    thirdRow = null;
    var type = $(state.element).attr('data-app_type');
	var quantity = $(state.element).attr('data-quantity');
	var installed = $(state.element).attr('data-installed');

	//indiv = $('<div class=""></div>');
    
    if (type == 'pre-installed-license') { // never limit
    	secondRow = $('<div></div>');
 
		firstRow.append('<i><strong>キー:</strong> '+ $(state.element).attr('data-product_key')+' </i>');
    	secondRow = $('<div>インストール済み: '+installed+'</div>');
    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
    	
	} else if (type == 'cpu-license') { // limit by quantity
		secondRow = $('<div></div>');
		firstRow.append('<i><strong>キー:</strong> '+ $(state.element).attr('data-product_key')+' </i>');
		secondRow.append('<strong>本数:</strong> '+ $(state.element).attr('data-quantity')+'&nbsp; &nbsp; &nbsp; ');
		secondRow.append('<strong>購入日:</strong> '+ $(state.element).attr('data-purchase_date')+' &nbsp; &nbsp; &nbsp;');
		secondRow.append('<strong>インストール済み:</strong> '+ $(state.element).attr('data-installed') +' &nbsp; &nbsp; &nbsp;');
		available = parseInt($(state.element).attr('data-quantity')) - parseInt($(state.element).attr('data-installed'));
    	secondRow.append('<strong>利用可能:</strong> '+ available +'');
    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
	} else if (type == 'user-fixed-license') { //limit by quantity and end date
		secondRow = $('<div></div>');
		firstRow.append('<i><strong>キー:</strong> '+ $(state.element).attr('data-product_key')+' </i>');
		secondRow.append('<strong>購入日:</strong> '+ $(state.element).attr('data-purchase_date')+' &nbsp; &nbsp; &nbsp;');
		secondRow.append('<strong>期間:</strong> '+ $(state.element).attr('data-duration')+'&nbsp; &nbsp; &nbsp; ');
		
		secondRow.append('<strong>インストール済み:</strong> '+ $(state.element).attr('data-installed') + '/' + $(state.element).attr('data-quantity') +' &nbsp; &nbsp; &nbsp;');
		available = parseInt($(state.element).attr('data-quantity')) - parseInt($(state.element).attr('data-installed'));
    	secondRow.append('<strong>利用可能:</strong> '+ available +' &nbsp; &nbsp; &nbsp;');

    	secondRow.append('<strong>ID:</strong> '+ $(state.element).attr('data-username') +' &nbsp; &nbsp; &nbsp;');
    	secondRow.append('<strong>パスワード:</strong> '+ $(state.element).attr('data-password') +'');

    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
	} else if (type == 'package-license') { //limit by quantity and disposal date
		secondRow = $('<div></div>');
		firstRow.append('<i><strong>シリアル番号:</strong> '+ $(state.element).attr('data-serial_number')+' </i>');
		secondRow.append('<strong>購入日:</strong> '+ $(state.element).attr('data-purchase_date')+' &nbsp; &nbsp; &nbsp;');
		secondRow.append('<strong>期間:</strong> '+ $(state.element).attr('data-duration')+'&nbsp; &nbsp; &nbsp; ');
		
		secondRow.append('<strong>インストール済み:</strong> '+ $(state.element).attr('data-installed') +' &nbsp; &nbsp; &nbsp;');
		available = parseInt($(state.element).attr('data-quantity')) - parseInt($(state.element).attr('data-installed'));
    	secondRow.append('<strong>利用可能:</strong> '+ available +'');
    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
    	if ($(state.element).attr('data-disposal_flag')) {
    		thirdRow = $('<div></div>');
    		thirdRow.append('<strong>廃棄日:</strong> '+ $(state.element).attr('data-disposal_date') +' &nbsp; &nbsp; &nbsp;');
    	}
	} else if (type == 'shareware') { //limit by quantity and disposal date
		secondRow = $('<div></div>');
		//firstRow.append('<i><strong>Serial:</strong> '+ $(state.element).attr('data-serial_number')+' </i>');
		secondRow.append('<strong>購入日:</strong> '+ $(state.element).attr('data-purchase_date')+' &nbsp; &nbsp; &nbsp;');
		secondRow.append('<strong>本数:</strong> '+ $(state.element).attr('data-quantity')+'&nbsp; &nbsp; &nbsp; ');
		
		secondRow.append('<strong>インストール済み:</strong> '+ $(state.element).attr('data-installed') +' &nbsp; &nbsp; &nbsp;');
		available = parseInt($(state.element).attr('data-quantity')) - parseInt($(state.element).attr('data-installed'));
    	secondRow.append('<strong>利用可能:</strong> '+ available +'');
    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
    	thirdRow = $('<div></div>');
    	company = $('<span class="glyphicon glyphicon-asterisk"></span> <i> '+$(state.element).attr('data-company')+' </i>');
    	thirdRow.append(company);
    	division = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-division')+' </i>');
    	thirdRow.append(division);
    	departement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-department')+' </i>');
    	thirdRow.append(departement);
    	if ($(state.element).attr('data-odepartment')) {
	        odepartement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-odepartment')+' </i>');
	        thirdRow.append(odepartement);
	    }
    	if ($(state.element).attr('data-disposal_flag')) {
    		thirdRow.append('<strong>廃棄日:</strong> '+ $(state.element).attr('data-disposal_date') +' &nbsp; &nbsp; &nbsp;');
    	}
	} else if (type == 'freeware') { // limit by PROHIBITION_DATE date
		secondRow = $('<div></div>');
		//firstRow.append('<i><strong>Serial:</strong> '+ $(state.element).attr('data-serial_number')+' </i>');
		secondRow.append('<strong>購入日:</strong> '+ $(state.element).attr('data-purchase_date')+' &nbsp; &nbsp; &nbsp;');
		//secondRow.append('<strong>Quantity:</strong> '+ $(state.element).attr('data-quantity')+'&nbsp; &nbsp; &nbsp; ');
		
		secondRow.append('<strong>インストール済み:</strong> '+ $(state.element).attr('data-installed') +' &nbsp; &nbsp; &nbsp;');
		// available = $(state.element).attr('data-quantity') - $(state.element).attr('data-installed');
  //   	secondRow.append('<strong>Available:</strong> '+ available +'');
    	if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
    	thirdRow = $('<div></div>');
    	company = $('<span class="glyphicon glyphicon-asterisk"></span> <i> '+$(state.element).attr('data-company')+' </i>');
    	thirdRow.append(company);
    	division = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-division')+' </i>');
    	thirdRow.append(division);
    	departement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-department')+' </i>');
    	thirdRow.append(departement);
    	if ($(state.element).attr('data-odepartment')) {
	        odepartement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-odepartment')+' </i>');
	        thirdRow.append(odepartement);
	    }
    	if ($(state.element).attr('data-prohibition_flag')) {
    		thirdRow.append('<div><strong>Drohibition date:</strong> '+ $(state.element).attr('data-prohibition_date') +' &nbsp; &nbsp; &nbsp;</div>');
    	}
	} else { //software-developed-in-house: never limit
		firstRow = $('<div><span class="badge badge-warning">'+$(state.element).attr('data-name')+'</span> </div>');
	    if ($(state.element).attr('data-version')) {
	    	firstRow = $('<div><span class="badge badge-warning">'+$(state.element).attr('data-name')+' - ' + $(state.element).attr('data-version') +'</span> </div>');
	    }
	    firstRow.append('<i class="float-right text-success">'+$(state.element).attr('data-maker_name')+'</i>');
	    firstRow.append('<i><strong>作成者:</strong> '+ $(state.element).attr('data-curator')+' &nbsp; &nbsp; &nbsp; </i>');
	    firstRow.append('<i><strong>インストール済み:</strong> '+ installed+' &nbsp; &nbsp; &nbsp; </i>');
	    firstRow.append('<i><strong>月額利用料:</strong> '+ $(state.element).attr('data-fee_month')+'&#165; </i>');
	    secondRow = $('<div></div>');
	    if (state.disabled) {
    		secondRow.append('<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span>');
    	} else {
    		secondRow.append('<span class="glyphicon glyphicon-ok-sign float-right text-success"></span>');
    	}
	    if ($(state.element).attr('data-database_info')) {
	    	secondRow.append('<div><strong>利用データベース情報:</strong> '+$(state.element).attr('data-database_info')+'</div>');
	    }
	    if ($(state.element).attr('data-firewall_info')) {
	    	secondRow.append('<div><strong>Firewall情報:</strong> '+$(state.element).attr('data-firewall_info')+'</div>');
	    }
	    if ($(state.element).attr('data-login_id') && $(state.element).attr('data-login_pass')) {
	    	secondRow.append('<div><strong>ログインID</strong> '+$(state.element).attr('data-login_id')+'&nbsp; &nbsp; &nbsp; <strong>Login Pass:</strong> ' +$(state.element).attr('data-login_pass')+ '</div>');
	    }
		//
	}
    //console.log(state)

    divParent.append(firstRow);
    divParent.append(secondRow);
    divParent.append(thirdRow);
    //var divParent =  + ;
    return $.merge($('<i class="text-muted">'+$(state.element).attr('data-app_type_name')+'</i>'), divParent);
};