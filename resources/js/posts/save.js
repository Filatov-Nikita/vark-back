import slugify from 'slugify';

const inpTitle = document.querySelector('#title');
const inpSlug = document.querySelector('#slug');

inpTitle.addEventListener('change', function(e) {
  const titleVal = e.target.value;
  const newSlug = slugify(titleVal, {
    replacement: '-',
    lower: true,
    locale: 'ru',
    strict: true,
  });
  inpSlug.value = newSlug;
});
