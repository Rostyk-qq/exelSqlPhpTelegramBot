document.addEventListener('DOMContentLoaded', function(e) {
    const form = document.querySelector('#form'); 
    const addBtn = document.querySelector('#content__button-add');
    const formSubmitBtn = document.querySelector('#footer_button-add');
    const editButton = document.querySelector('#table__btn-edit'); 
    const formTitle = document.querySelector('.modal-header .modal-title');

    const array = [];

    const user = {
        id: array.length + 1,
        firstname: '',
        secondname: '',
        role: '',
        status: '',
    }
    
    addBtn.onclick = () => {
        formTitle.innerText = 'Add User';
        formSubmitBtn.innerText = 'Add';

        user.id = user.id;
        user.firstname = '';
        user.secondname = '';
        user.role = '';
        user.status = '';

        form.reset();
    };

    editButton.onclick = () => {
        formTitle.innerText = 'Edit User';
        formSubmitBtn.innerText = 'Edit';

        form.elements['id'] = user.id;
        form.elements['firstname'] = user.firstname;
        form.elements['secondname'] = user.secondname;
        form.elements['role'] = user.role;
        form.elements['status'] = user.status;
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const userValues = {
            id: user.id,
            firstname: form.elements['firstname'].value,
            secondname: form.elements['secondname'].value,
            role: form.elements['role'].value,
            status: form.elements['status'].checked,
        };

            try {
                const data = await sendToBack('POST', userValues);
                if (data.error) {
                    let message = data.error;
                    alert(message.message);
                } else {

                    user.id = data.id;
                    user.firstname = data.firstname;
                    user.secondname = data.secondname;
                    user.role = data.role;
                    user.status = data.status;

                    array.push(user);
                    console.log(array, array.length);
                }
            } catch (error) {
                console.error('Error:', error);
            }
    });
    