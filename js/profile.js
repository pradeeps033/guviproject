function getAgeFromDob(dob) {
  const today = new Date();
  const birthDate = new Date(dob);
  let age = today.getFullYear() - birthDate.getFullYear();
  const m = today.getMonth() - birthDate.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
    age--;
  }
  return age;
}
console.log("JS code is being executed");
document.querySelector('form').addEventListener('submit', async (e) => {
  e.preventDefault();

  const name = document.querySelector('#name').value.trim();
  const dob = document.querySelector('#dob').value.trim();
  const age = getAgeFromDob(dob);
  document.querySelector('#age').value = age;
  const email = document.querySelector('#email').value.trim();
  const phone = document.querySelector('#phone').value.trim();
  const bio = document.querySelector('#bio').value.trim();

  const formData = new FormData();
  formData.append('name', name);
  formData.append('dob', dob);
  formData.append('age', age);
  formData.append('email', email);
  formData.append('phone', phone);
  formData.append('bio', bio);

  const response = await fetch('php/profile.php', {
    method: 'POST',
    body: formData
  });

  const result = await response.text();
  console.log(result);
});
