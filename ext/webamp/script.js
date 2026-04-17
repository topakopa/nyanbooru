document.addEventListener("DOMContentLoaded", () => {
    initWebamp();
});

async function initWebamp() {
    let post = document.getElementById("shm_post_media");
    let container = document.createElement("div");

    let audioLink = null;
    let ogPlayer = null;

    if (post == null) {
        return;
    }

    post.childNodes.forEach((e) => {
        if (e.tagName == "AUDIO") {
            ogPlayer = e;
            audioLink = e.firstChild.src;
        }
    });

    if (audioLink == null || ogPlayer == null) {
        return;
    }

    module = await import("/ext/webamp/webamp.butterchurn-bundle.min.mjs.js");
    Webamp = module.default;

    const webamp = new Webamp({
        initialTracks: [
            {
                url: audioLink,
            },
        ],
        windowLayout: {
            main: {
                position: { top: 0, left: 0 },
                shadeMode: false,
                closed: false,
            },
        },
        enableMediaSession: true,
        // ... optional initialization options like initial tracks, skin, etc. can be
        // supplied here.
    });

    // Check if Winamp is supported and replace og player
    if (Webamp.browserIsSupported()) {
        post.childNodes.forEach((e) => {
            if (e.tagName == "AUDIO") {
                e.style = "display: none;";
            }
        });
        post.appendChild(container);
        container.id = "webamp-container";
        webamp.renderWhenReady(container);
    }
}
