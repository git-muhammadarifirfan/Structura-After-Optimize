import './bootstrap';
import './login';
import './register';
import './product';
import './profile';


// PENANDA BAB IV - WPO: atribut loading/decoding gambar non-prioritas.
// Global image perf: ensure lazy loading for images without explicit attributes
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('img:not([loading])').forEach((img) => img.setAttribute('loading', 'lazy'));
  document.querySelectorAll('img:not([decoding])').forEach((img) => img.setAttribute('decoding', 'async'));
});
