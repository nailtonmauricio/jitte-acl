/** IMPORTANDO FRAMEWORK BOOTSTRAP */
import 'bootstrap';
import axios from 'axios';
window.axios = axios;

/** IMPORTANDO COMPONENTE SWEETALERT2 */
import Swal from "sweetalert2";
window.Swal = Swal;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
