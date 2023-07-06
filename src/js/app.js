'use strict';

// import './config.js';
// import 'alpinejs';
// import SimpleBar from 'simplebar';
// import GLightbox from 'glightbox';
// import Rellax from 'rellax';
import Choices from 'choices.js';
import Tagify from '@yaireo/tagify';
// import MicroModal from 'micromodal';
// import LazyLoad from "vanilla-lazyload";
// import { tns } from 'tiny-slider/src/tiny-slider';
// import './modules/bootstrap-modules.js';
// import './modules/markjs.js';
// import './modules/smooth-scroll.js';
// import './modules/scroll-to-top.js';
// import './modules/timezone-offset.js';
import { $on, qs, qsa } from './modules/utils';

console.log('Init 1');

$on(document, 'DOMContentLoaded', () => {
    console.log('Init 2');

    /**
     * init micromodal
     */
    // MicroModal.init();

    /**
     * taglists
     */
    if (qs('[data-tagify]')) {
        // eslint-disable-next-line no-unused-vars
        let tagsTagify = [];

        qsa('[data-tagify]').forEach((el, i) => {
            tagsTagify[el.getAttribute('id')] = new Tagify(el, {
                // eslint-disable-next-line no-undef
                whitelist: whitelist || [],
                maxTags: 10,
                dropdown: {
                    classname: 'tags-look',
                    enabled: 0,
                    maxItems: 20,
                    closeOnSelect: false,
                },
            });

            console.log(el.getAttribute('id'));
            console.log(whitelist);
            console.log(tagsTagify[el.getAttribute('id')]);
        });
    }

    /**
     * select fields
     * @type {Choices}
     */
    // eslint-disable-next-line no-unused-vars
    let choices = [];
    if (qs('data-choices')) {
        qsa('data-choices').forEach((el) => {
            choices[el.dataSet.choices] = new Choices(el);
        });
    }
});

import '../scss/styles.scss';
