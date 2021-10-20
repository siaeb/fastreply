jQuery(document).ready(function($) {

  const fastreply = (function() {

    // Display ready-template buttons
    const showButtons = function() {
      const wrapper = $('.comment-reply').find('#replycontainer');
      if (wrapper.length === 0 || !fr_templates || fr_templates.length === 0) {
        return;
      }

      const elements = document.createElement('div');
      elements.className = 'fast-reply-container';
      for (let i = 0; i < fr_templates.length; i++) {
        const button = document.createElement('button');
        button.textContent = fr_templates[i].title;
        button.setAttribute('data-text', fr_templates[i].text);
        elements.appendChild(button);
      }

      wrapper.prepend(elements);
    };

    // Register Event Listeners
    const registerEventListeners = function() {
      $(document).on('click', '.fast-reply-container button', function() {
        const text = $(this).data('text');
        document.getElementById('replycontent').value = text;
        return false;
      });
    };

    return {
      init: function() {
        showButtons();
        registerEventListeners();
      },
    };
  })();

  fastreply.init();

});
