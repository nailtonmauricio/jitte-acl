import './bootstrap';
import './scripts-admin';
import './scripts-sbadmin';
import './charts/failedLoginStatistics';
import { MaskInput } from "maska";
import { Tooltip } from 'bootstrap';
import '@fortawesome/fontawesome-free/js/all.js';

document.addEventListener('DOMContentLoaded', () => {
    // Inicializa Maska para todos os inputs com o seletor data-maska
    new MaskInput("[data-maska]");

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(tooltipTriggerEl => {
        new Tooltip(tooltipTriggerEl);
    });
});
