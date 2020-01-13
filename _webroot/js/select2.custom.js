function stringMatch(term, candidate) {
    var re = candidate && term &&  candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
    // console.log(term.toLowerCase());
    // console.log(candidate);
    // if (!re && term) {
    //     var unicodeString = Encoding.convert(term.toLowerCase(), {
    //       to: 'UNICODE',
    //       from: 'UTF8',
    //       type: 'string' // Specify 'string' type. (Return as string)
    //     });
    //     console.log(term.toLowerCase());
    //     re = candidate && candidate.toLowerCase().indexOf(unicodeString) >= 0;
    // }
    return re;
}

function matchLocation(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }
    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
        return null;
    }
    // Match text of option
    if (stringMatch(params.term, data.text)) {
        return data;
    }
    // Match attribute "data-code" of option
    if (stringMatch(params.term, $(data.element).attr('data-code'))) {
        return data;
    }
    // Match attribute "data-address" of option
    if (stringMatch(params.term, $(data.element).attr('data-address'))) {
        return data;
    }
    // Match attribute "data-phone1" of option
    if (stringMatch(params.term, $(data.element).attr('data-phone1'))) {
        return data;
    }
    // Match attribute "data-phone2" of option
    if (stringMatch(params.term, $(data.element).attr('data-phone2'))) {
        return data;
    }
    // Match attribute "data-curator" of option
    if (stringMatch(params.term, $(data.element).attr('data-curator'))) {
        return data;
    }
    // Return `null` if the term should not be displayed
    return null;
}

function formatLocation(state) {
    var div = $('<div></div>');
    div.append('<div><span class="badge badge-success">'+$(state.element).attr('data-code')+'</span> ' + state.text + '</div>');
    var address = null;
    var phone = null;
    var curator = null;
    if ($(state.element).attr('data-address')) {
        address = $('<div class="small"><span class="showopacity glyphicon glyphicon-map-marker"></span> <i>'+$(state.element).attr('data-address')+'</i></div>');
        div.append(address);
    }
    if ($(state.element).attr('data-phone1') || $(state.element).attr('data-phone2')) {
        var ar = [];
        if ($(state.element).attr('data-phone1')) { 
            ar.push($(state.element).attr('data-phone1'));
        }
        if ($(state.element).attr('data-phone2')) { 
            ar.push($(state.element).attr('data-phone2'));
        }
        //console.log(ar);
        phone = $('<div class="small text-muted"><span class="showopacity glyphicon glyphicon-phone-alt"></span> <i>' + ar.join(" - ") + '</i></div>');
        div.append(phone);
    }
    if ($(state.element).attr('data-curator')) {
        curator = $('<div class="small text-muted"><span class="showopacity glyphicon glyphicon-user"></span> <i>'+$(state.element).attr('data-curator')+'</i></div>');
        div.append(curator);
    }
    return div;
}

function matchDeviceUser(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }
    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
        return null;
    }
    // Match text of option
    if (stringMatch(params.term, data.text)) {
        return data;
    }
    // Match attribute "data-code" of option
    if (stringMatch(params.term, $(data.element).attr('data-code'))) {
        return data;
    }
    // Match attribute "data-address" of option
    if (stringMatch(params.term, $(data.element).attr('data-email'))) {
        return data;
    }
    // Match attribute "data-phone" of option
    if (stringMatch(params.term, $(data.element).attr('data-phone'))) {
        return data;
    }
    // Match attribute "data-ext" of option
    if (stringMatch(params.term, $(data.element).attr('data-ext'))) {
        return data;
    }

    // Return `null` if the term should not be displayed
    return null;
}

function formatDeviceUser(state) {
    var div = $('<div></div>');
    var off  = $(state.element).attr('data-off');
    if (!off) {
        div.append('<div><span class="badge badge-success">'+$(state.element).attr('data-code')+'</span> ' + state.text + '<span class="glyphicon glyphicon-ok-sign float-right text-success"></span></div>');
    } else {
        div.append('<div><span class="badge badge-success">'+$(state.element).attr('data-code')+'</span> ' + state.text + '<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span></div>');
    }
    
    //div.append(row);
    var div1 = $('<div class="small"></div>');
    var email = null;
    var phone = null;
    var curator = null;
    if ($(state.element).attr('data-email')) {
        email = $('<span class="glyphicon glyphicon-envelope"></span> <i>'+$(state.element).attr('data-email')+'</i>');
        div1.append(email);
    }
    
    if ($(state.element).attr('data-phone')) {
        var ar = [];
        if ($(state.element).attr('data-phone')) { 
            ar.push($(state.element).attr('data-phone'));
        }
        if ($(state.element).attr('data-ext')) { 
            ar.push($(state.element).attr('data-ext'));
        }
        //console.log(ar);
        phone = $('<span class="glyphicon glyphicon-phone-alt"></span> <i>' + ar.join(" - ") + '</i>');
        div1.append(' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ');
        div1.append(phone);
    }
    div.append(div1);
    var row = $('<div class="small"></div>');
    if ($(state.element).attr('data-company')) {
        company = $('<span class="glyphicon glyphicon-asterisk"></span> <i> '+$(state.element).attr('data-company')+' </i>');
        row.append(company);
    }
    if ($(state.element).attr('data-division')) {
        division = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-division')+' </i>');
        row.append(division);
    }
    if ($(state.element).attr('data-departement')) {
        departement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-departement')+' </i>');
        row.append(departement);
    }
    if ($(state.element).attr('data-odepartement')) {
        odepartement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-odepartement')+' </i>');
        row.append(odepartement);
    }
    div.append(row);
    return div;
}


function formatState (state) {
  if (!state.id) {
    return state.text;
  }
  var $state = $(
    '<span><span class="badge badge-success">Success Label</span>' + state.text + '</span>'
  );
  return $state;
};



function matchAD(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }
    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
        return null;
    }
    // // Match text of option
    // if (stringMatch(params.term, data.text)) {
    //     return data;
    // }
    // Match attribute "data-code" of option
    if (stringMatch(params.term, $(data.element).attr('data-code'))) {
        return data;
    }
    // Match attribute "data-address" of option
    if (stringMatch(params.term, $(data.element).attr('data-company'))) {
        return data;
    }
    // Match attribute "data-phone" of option
    if (stringMatch(params.term, $(data.element).attr('data-division'))) {
        return data;
    }
    // Match attribute "data-ext" of option
    if (stringMatch(params.term, $(data.element).attr('data-department'))) {
        return data;
    }
    // Match attribute "data-ext" of option
    if (stringMatch(params.term, $(data.element).attr('data-odepartment'))) {
        return data;
    }

    // Return `null` if the term should not be displayed
    return null;
}

function formatAD(state) {
    var div = $('<div></div>');
    var span = $(' <span class="badge badge-success" style="margin-top: 2px;">'+$(state.element).attr('data-code')+'</span> ');
    div.append(span);
    var span = $(' <span class=""></span>');
    span.append('<span class="glyphicon glyphicon glyphicon-chevron-right"></span> ' + $(state.element).attr('data-company'));
    span.append('<span class="glyphicon glyphicon glyphicon-chevron-right"></span> ' + $(state.element).attr('data-division'));
    span.append('<span class="glyphicon glyphicon glyphicon-chevron-right"></span> ' + $(state.element).attr('data-department'));
    if ($(state.element).attr('data-odepartment')) {
        span.append('<span class="glyphicon glyphicon glyphicon-chevron-right"></span> ' + $(state.element).attr('data-odepartment'));
    }
    div.append(span);
    var row = $('<div class="small"></div>');
    row.append('<div><span class="glyphicon glyphicon-th-large"></span> <strong>会社:</strong> ' + $(state.element).attr('data-company') + '</div>');
    row.append('<div><span class="glyphicon glyphicon-flag"></span> <strong>事業本部:</strong> ' + $(state.element).attr('data-division')+ '</div>');
    row.append('<div><span class="glyphicon glyphicon-th"></span> <strong>事業部:</strong> ' + $(state.element).attr('data-department')+ '</div>');
    if ($(state.element).attr('data-odepartment')) {
        row.append('<div><span class="glyphicon glyphicon-th-list"></span> <strong>その他部署:</strong> ' + $(state.element).attr('data-odepartment')+ '</div>');
    }
    div.append(row);
    return div;
}
function formatSelectionFullAd (state) {
  if (!state.id) {
    return state.text;
  }

  var div = $('<div></div>');
    var span = $(' <span class="badge badge-success" style="margin-top: 2px;">'+$(state.element).attr('data-code')+'</span> ');
    div.append(span);
    var span = $(' <span class=""></span>');
    span.append('<span class="glyphicon glyphicon glyphicon-chevron-right"></span> ' + $(state.element).attr('data-company'));
    span.append('<span class="glyphicon glyphicon glyphicon-chevron-right"></span> ' + $(state.element).attr('data-division'));
    span.append('<span class="glyphicon glyphicon glyphicon-chevron-right"></span> ' + $(state.element).attr('data-department'));
    if ($(state.element).attr('data-odepartment')) {
        span.append('<span class="glyphicon glyphicon glyphicon-chevron-right"></span> ' + $(state.element).attr('data-odepartment'));
    }
    div.append(span);
    var row = $('<div class="small"></div>');
    row.append('<div><span class="glyphicon glyphicon-th-large"></span> <strong>会社:</strong> ' + $(state.element).attr('data-company') + '</div>');
    row.append('<div><span class="glyphicon glyphicon-flag"></span> <strong>事業本部:</strong> ' + $(state.element).attr('data-division')+ '</div>');
    row.append('<div><span class="glyphicon glyphicon-th"></span> <strong>事業部:</strong> ' + $(state.element).attr('data-department')+ '</div>');
    if ($(state.element).attr('data-odepartment')) {
        row.append('<div><span class="glyphicon glyphicon-th-list"></span> <strong>その他部署:</strong> ' + $(state.element).attr('data-odepartment')+ '</div>');
    }
    div.append(row);
    return div;
};
function formatSelectionAd (state) {
  if (!state.id) {
    return state.text;
  }

  var div = $('<span></span>');
  
  div.append(' <span class="glyphicon glyphicon-chevron-right"></span><span class="text-primary"> <strong>会社: </strong>'+$(state.element).attr('data-company')+' </span>');
  div.append(' <span class="glyphicon glyphicon glyphicon-chevron-right"></span><span class="text-success"> <strong>事業本部: </strong>'+$(state.element).attr('data-division')+' </span>');
  div.append(' <span class="glyphicon glyphicon glyphicon-chevron-right"></span><span class="text-info"> <strong>事業部: </strong>'+$(state.element).attr('data-department')+' </span>');
  if ($(state.element).attr('data-odepartment')) {
    div.append(' <span class="glyphicon glyphicon glyphicon-chevron-right"></span><span class="text-danger"> <strong>その他部署: </strong>'+$(state.element).attr('data-odepartment')+' </span>');
  }
  var span = $(' <span class="badge badge-success float-right" style="margin-top: 2px;">'+$(state.element).attr('data-code')+'</span> ');
  div.append(span);
  return div;
};
function formatSelectionWithCode (state) {
  if (!state.id) {
    return state.text;
  }
  var span = $('<span>' + state.text + '</span>');
  if ($(state.element).attr('data-code')) {
    span = $('<span class="badge badge-success code">'+$(state.element).attr('data-code')+'</span> <span>' + state.text + '</span>');
  }
  
  return span;
};

function formatSelectionFullLocation (state) {
    if (!state.id) {
        return state.text;
    }
    var div = $('<div></div>');
    var span = $('<span>' + state.text + '</span>');
    if ($(state.element).attr('data-code')) {
        span = $('<span class="badge badge-success code">'+$(state.element).attr('data-code')+'</span> <span>' + state.text + '</span>');
    }
    div.append(span);
    var address = null;
    var phone = null;
    var curator = null;
    if ($(state.element).attr('data-address')) {
        address = $('<div class="small"><span class="showopacity glyphicon glyphicon-map-marker"></span> <i>'+$(state.element).attr('data-address')+'</i></div>');
        div.append(address);
    }
    if ($(state.element).attr('data-phone1') || $(state.element).attr('data-phone2')) {
        var ar = [];
        if ($(state.element).attr('data-phone1')) { 
            ar.push($(state.element).attr('data-phone1'));
        }
        if ($(state.element).attr('data-phone2')) { 
            ar.push($(state.element).attr('data-phone2'));
        }
        phone = $('<div class="small text-muted"></div>');
        //console.log(ar);
        phone.append('<span class="showopacity glyphicon glyphicon-phone-alt"></span> <i>' + ar.join(" - ") + '</i> ');
        
    }
    if ($(state.element).attr('data-curator')) {
        if (phone == null) {
            phone = $('<div class="small text-muted"></div>');
        }
        curator = $('<span class="showopacity glyphicon glyphicon-user"></span> <i>'+$(state.element).attr('data-curator')+'</i>');
        phone.append(curator);
    }
    if (phone != null) {
        div.append(phone);
    }
    return div;
};

function formatSelectionFullDeviceUser(state) {
    if (!state.id) {
        return state.text;
    }
    var div = $('<div></div>');
    var off  = $(state.element).attr('data-off');
    if (!off) {
        div.append('<div><span class="badge badge-success">'+$(state.element).attr('data-code')+'</span> ' + state.text + '<span class="glyphicon glyphicon-ok-sign float-right text-success"></span></div>');
    } else {
        div.append('<div><span class="badge badge-success">'+$(state.element).attr('data-code')+'</span> ' + state.text + '<span class="glyphicon glyphicon-remove-sign float-right text-danger"></span></div>');
    }
    
    //div.append(row);
    var div1 = $('<div class="small"></div>');
    var email = null;
    var phone = null;
    var curator = null;
    if ($(state.element).attr('data-email')) {
        email = $('<span class="glyphicon glyphicon-envelope"></span> <i>'+$(state.element).attr('data-email')+'</i>');
        div1.append(email);
    }
    
    if ($(state.element).attr('data-phone')) {
        var ar = [];
        if ($(state.element).attr('data-phone')) { 
            ar.push($(state.element).attr('data-phone'));
        }
        if ($(state.element).attr('data-ext')) { 
            ar.push($(state.element).attr('data-ext'));
        }
        //console.log(ar);
        phone = $('<span class="glyphicon glyphicon-phone-alt"></span> <i>' + ar.join(" - ") + '</i>');
        div1.append(' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ');
        div1.append(phone);
    }
    div.append(div1);
    var row = $('<div class="small"></div>');
    if ($(state.element).attr('data-company')) {
        company = $('<span class="glyphicon glyphicon-asterisk"></span> <i> '+$(state.element).attr('data-company')+' </i>');
        row.append(company);
    }
    if ($(state.element).attr('data-division')) {
        division = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-division')+' </i>');
        row.append(division);
    }
    if ($(state.element).attr('data-departement')) {
        departement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-departement')+' </i>');
        row.append(departement);
    }
    if ($(state.element).attr('data-odepartement')) {
        odepartement = $('<span class="glyphicon glyphicon-chevron-right"></span> <i>'+$(state.element).attr('data-odepartement')+' </i>');
        row.append(odepartement);
    }
    div.append(row);
    return div;
}



function matchCode(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }
    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
        return null;
    }
    // Match text of option
    if (stringMatch(params.term, data.text)) {
        return data;
    }
    // Match attribute "data-code" of option
    if (stringMatch(params.term, $(data.element).attr('data-code'))) {
        return data;
    }
    // Return `null` if the term should not be displayed
    return null;
}

function formatCode(state) {
    var div = $('<span></span>');
    var span = $('<span> ' + state.text + '</span>');
    if ($(state.element).attr('data-code')) {
        div.append('<span class="badge badge-success">'+$(state.element).attr('data-code')+'</span>');
    }
    div.append(span);
    return div;
}

function matchDevice(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }
    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
        return null;
    }
    // Match text of option
    if (stringMatch(params.term, data.text)) {
        return data;
    }
    // Match attribute "data-user" of option
    if (stringMatch(params.term, $(data.element).attr('data-user'))) {
        return data;
    }

     // Match attribute "data-code" of option
    if (stringMatch(params.term, $(data.element).attr('data-code'))) {
        return data;
    }

    // Return `null` if the term should not be displayed
    return null;
}

function formatDevice(state) {
    var div = $('<div></div>');
    //div.append(row);
    //var div1 = $('<div class="small"></div>');
    var user = null;
    var name = null;
    div.append('<div><span class="badge badge-success">'+$(state.element).attr('data-code')+'</span> ' + state.text + '<span class="glyphicon glyphicon-wrench float-right"></span></div>');
    var div1 = $('<div class="small"></div>');
    if ($(state.element).attr('data-user')) {
        user = $('<span class="glyphicon glyphicon-user"></span> <i>'+$(state.element).attr('data-user')+'</i>');
        div1.append(user);
    }
    div.append(div1);
    //div.append(div1);
    return div;
}

function formatSelectionFullDevice(state) {
    if (!state.id) {
        return state.text;
    }
    var div = $('<div></div>');
    //div.append(row);
    //var div1 = $('<div class="small"></div>');
    var user = null;
    var name = null;
    div.append('<div><span class="badge badge-success">'+$(state.element).attr('data-code')+'</span> ' + state.text + '<span class="glyphicon glyphicon-wrench float-right"></span></div>');
    var div1 = $('<div class="small"></div>');
    if ($(state.element).attr('data-user')) {
        user = $('<span class="glyphicon glyphicon-user"></span> <i>'+$(state.element).attr('data-user')+'</i>');
        div1.append(user);
    }
    div.append(div1);
    //div.append(div1);
    return div;
}

function matchExternalDevice(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }
    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
        return null;
    }
    // Match text of option
    if (stringMatch(params.term, data.text)) {
        return data;
    }
    // Match attribute "data-user" of option
    if (stringMatch(params.term, $(data.element).attr('data-user'))) {
        return data;
    }
    // Return `null` if the term should not be displayed
    return null;
}

function formatExternalDevice(state) {
    var div = $('<div></div>');
    //div.append(row);
    //var div1 = $('<div class="small"></div>');
    var user = null;
    var name = null;
    div.append('<div><span class="glyphicon glyphicon-earphone float-left"></span>' + state.text + '</div>');
    var div1 = $('<div class="small"></div>');
    if ($(state.element).attr('data-user')) {
        user = $('<span class="glyphicon glyphicon-user"></span> <i>'+$(state.element).attr('data-user')+'</i>');
        div1.append(user);
    }
    div.append(div1);
    //div.append(div1);
    return div;
}

function formatSelectionExternalDevice(state) {
    if (!state.id) {
        return state.text;
    }
    var div = $('<div></div>');
    //div.append(row);
    //var div1 = $('<div class="small"></div>');
    var user = null;
    var name = null;
    div.append('<div><span class="glyphicon glyphicon-earphone float-left"></span>' + state.text + '</div>');
    var div1 = $('<div class="small"></div>');
    if ($(state.element).attr('data-user')) {
        user = $('<span class="glyphicon glyphicon-user"></span> <i>'+$(state.element).attr('data-user')+'</i>');
        div1.append(user);
    }
    div.append(div1);
    //div.append(div1);
    return div;
}
