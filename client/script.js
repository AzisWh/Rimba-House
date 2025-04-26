const API_URL = ENV.API_URL;

const form = document.getElementById('form');
const tableBody = document.getElementById('table-body');
const modal = document.getElementById('modal');
const modalTitle = document.getElementById('modal-title');

function openModal(edit = false) {
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  modalTitle.textContent = edit ? 'Edit User' : 'Tambah User';
}

function closeModal() {
  modal.classList.add('hidden');
  modal.classList.remove('flex');
  form.reset();
  document.getElementById('user-id').value = '';
}

async function fetchUsers() {
  const res = await fetch(`${API_URL}/allUser`);
  const users = await res.json();
  renderTable(users);
}

function renderTable(users) {
  tableBody.innerHTML = '';
  users.forEach((user) => {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td class="p-2">${user.name}</td>
        <td class="p-2">${user.email}</td>
        <td class="p-2">${user.age}</td>
        <td class="p-2 space-x-2">
          <button onclick="editUser('${user.id}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
          <button onclick="deleteUser('${user.id}')" class="bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
        </td>
      `;
    tableBody.appendChild(row);
  });
}

form.addEventListener('submit', async (e) => {
  e.preventDefault();

  const id = document.getElementById('user-id').value;
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const age = parseInt(document.getElementById('age').value);

  if (!name || !email || !age || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    Swal.fire('Error', 'Pastikan semua field terisi dan email valid!', 'error');
    return;
  }

  const payload = { name, email, age };

  let res;
  try {
    if (id) {
      res = await fetch(`${API_URL}/user/editUser/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });
    } else {
      res = await fetch(`${API_URL}/user/addUser`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });
    }

    if (!res.ok) {
      const data = await res.json();
      if (data.errors && data.errors.email) {
        Swal.fire('Error', 'Email sudah terdaftar!', 'error');
      } else {
        Swal.fire('Error', data.message || 'Terjadi kesalahan', 'error');
      }
      return;
    }

    const message = id ? 'User berhasil diupdate' : 'User berhasil ditambahkan';
    Swal.fire('Berhasil', message, 'success');
    closeModal();
    fetchUsers();
  } catch (error) {
    Swal.fire('Error', 'Terjadi kesalahan di server', 'error');
  }
});

window.editUser = async (id) => {
  const res = await fetch(`${API_URL}/user/${id}`);
  const user = await res.json();
  document.getElementById('user-id').value = user.id;
  document.getElementById('name').value = user.name;
  document.getElementById('email').value = user.email;
  document.getElementById('age').value = user.age;
  openModal(true);
};

window.deleteUser = async (id) => {
  const confirm = await Swal.fire({
    title: 'Yakin?',
    text: 'Data user akan dihapus secara permanen!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Ya, hapus!',
  });

  if (confirm.isConfirmed) {
    await fetch(`${API_URL}/user/delUser/${id}`, { method: 'DELETE' });
    Swal.fire('Dihapus!', 'Data user berhasil dihapus.', 'success');
    fetchUsers();
  }
};

fetchUsers();
