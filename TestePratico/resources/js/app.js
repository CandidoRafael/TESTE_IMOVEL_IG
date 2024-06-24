import './bootstrap';

import Inputmask from 'inputmask';

document.addEventListener('DOMContentLoaded', () => {
    const cpf = document.getElementById("cpf");

    const cpfMask = new Inputmask("999.999.999-99");
    cpfMask.mask(cpf);

    const tableCPF = document.querySelectorAll('.table-cpf');  
    
    tableCPF.forEach(table => cpfMask.mask(table));
    
    cpfMask.mask(tableCPF);
});