import { quintOut } from 'svelte/easing';
import { crossfade, fade, scale } from 'svelte/transition';

export {send, receive};

const [send, receive] = crossfade({
    duration: 4000,
    easing: quintOut,
    fallback: scale
    /*
    fallback(node, params) {
        const style = getComputedStyle(node);
        const transform = style.transform === 'none' ? '' : style.transform;

        return {
            duration: 6000,
            easing: quintOut,
            css: t => `
                transform: ${transform} scale(${t});
                opacity: ${t}
            `
        };
    }
     */
});

