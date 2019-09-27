const errorField = (o, tooltip) => {
  var position;
  position = o.position();
  if ($(o).next(".control-tooltip").length === 0) {
    $("<span class='control-tooltip text-danger'>" + tooltip + "</span>").insertAfter(o);
    $(o).addClass('errors');
  }
  return false;
}

export const minLenght = (o, minLength, tooltip ) => {
  if( o.val().length < minLength || $(o).val() === $(o).attr('placeholder')){
    errorField(o, tooltip);
  }else{
    $(o).removeClass("errors").siblings("span").remove();
    return true;
  }
}

export const checkReg = (o, regexp, tooltip) => {
  if (!(regexp.test(o.val())) || o.val() === $(o).attr('placeholder')) {
    errorField(o, tooltip);
  } else {
    $(o).removeClass("errors").siblings("span").remove();
    return true;
  }
}
