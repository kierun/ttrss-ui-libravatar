require(['dojo/_base/kernel', 'dojo/ready'], function  (dojo, ready) {
    ready(function() {
        PluginHost.register(PluginHost.HOOK_INIT_COMPLETE, () => {
            const btn = document.querySelector(".action-chooser .dijitButtonText");

            if (btn)
                btn.innerHTML = "<img referrerpolicy='no-referrer' class='userpic-libravatar' src=\"https://seccdn.libravatar.org/avatar/%LIBRAVATAR_HASH%?s=96\">";

            return true;
        });
    });
});
