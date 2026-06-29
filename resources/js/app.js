import './bootstrap';
import './login';
import './register';
import './product';
import './profile';


// Global image perf: ensure lazy loading for images without explicit attributes
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('img:not([loading])').forEach((img) => img.setAttribute('loading', 'lazy'));
  document.querySelectorAll('img:not([decoding])').forEach((img) => img.setAttribute('decoding', 'async'));
});
