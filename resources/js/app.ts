import './bootstrap'
import { createInertiaApp } from '@inertiajs/svelte'
import { mount } from 'svelte'

createInertiaApp({
    resolve: name => import(`./Pages/${name}.svelte`),
    setup({ el, App, props }) {

        mount(App, { target: el!, props })
    },
    progress: { color: '#4B5563' }, // 進捗バー（任意）
})
