;(function($, window, document){
  'use-strict';

  $(window).bind('load', function(e){
    var phones = /\+?1?[\-\s\.]?\(?(\d{3})\)?[\-\s\.]?(\d{3})[\-\s\.]?(\d{4})/g, emails = /(\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*)/g;

    if(!$('body').hasClass('page-admin') && !location.href.match(/\/(admin|challenge|node\/.*\/edit)/)){
      $('body :not(script):not(input):not(select):not(option):not(textarea):not(form):not(noscript):not(img):not(style):not(a):not(iframe):not(object):not(embed):not(meta):not(link)')
      .contents()
      .filter(function(){
        return this.nodeType === 3;
      })
      .replaceWith(function(){
        if(this.nodeValue.match(phones)){
          return this.nodeValue.replace(phones, ' <a href="tel:$1-$2-$3" class="phone-link-processed">$1-$2-$3</a>');
        } else {
          if(this.nodeValue.match(emails)){
            return this.nodeValue.replace(emails, ' <a href="mailto:$1" class="email-link-processed" target="_blank">$1</a>');
          } else {
            return this.nodeValue;
          }
        }
      });

      $('a[href^="tel"]:not(.phone-link-processed)').each(function(i, o){
        $(o).attr('href', $(o).attr('href').replace(phones, '$1-$2-$3'));
        $(o).text($(o).text().replace(phones, '$1-$2-$3'));
        $(o).addClass('phone-link-processed');
      });

      $('a[href^="mailto"]:not(.email-link-processed)').each(function(i, o){
        $(o).attr('href', $(o).attr('href').replace(emails, '$1'));
        $(o).text($(o).text().replace(emails, '$1'));
        $(o).addClass('email-link-processed');
        $(o).attr('target', '_blank');
      });

      $('a[href^="mailto:"]').on('click', function(e){
        trackLead('email '+($(this).attr('href').replace(/mailto:/, '')));
      });

      $('a[href^="tel:"]').on('click', function(e){
        trackLead('call '+($(this).attr('href').replace(/tel:/, '')));
      });
    }
  });
})(window.jQuery, window, document, undefined);

function trackLead(label){
  return {
    'ga'  : checkGA(label),
    'gtag': checkGTag(label),
    'fb'  : checkFB(label)
  }
}

function checkFB(source){
  var o = false;

  if(typeof fbq !== undefined && typeof fbq == 'function'){
    fbq('track', 'Lead', {
      value: source,
    });

    o = true;
  }

  return o;
}

function checkGA(label){
  var o = false;

  if(typeof ga !== undefined && typeof ga == 'function'){
    ga('send', 'event', 'lead', 'click', label);

    o = true;
  }

  return o;
}

function checkGTag(label){
  var o = false;

  if(typeof gtag !== undefined && typeof gtag == 'function'){
    gtag('event', 'click', {
      'event_category' : 'lead',
      'event_label' : label
    });

    o = true;
  }

  return o;
}