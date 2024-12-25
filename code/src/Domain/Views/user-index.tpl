<p>Список пользователей в хранилище</p>

<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Фамилия</th>
                <th scope="col">День рождения</th>
                {% if 'admin' in user_roles %}
                <th scope="col">Действия</th>
                {% endif %}
            </tr>
        </thead>
        <tbody>
            {% for user in users %}
            <tr>
                <td>{{ user.getUserId() }}</td>
                <td>{{ user.getUserName() }}</td>
                <td>{{ user.getUserLastName() }}</td>
                <td>
                    {% if user.getUserBirthday() is not empty %}
                        {{ user.getUserBirthday() | date('d.m.Y') }}
                    {% else %}
                        <b>Не задан</b>
                    {% endif %}
                </td>
                {% if 'admin' in user_roles %}
                <td>
                    <a href="/user/edit/?id={{ user.getUserId() }}" class="btn btn-sm btn-warning">Редактировать</a>
                    <button class="btn btn-sm btn-danger delete-user" data-id="{{ user.getUserId() }}">Удалить</button>
                </td>
                {% endif %}
            </tr>
            {% endfor %}
        </tbody>
    </table>
</div>

<script>
    $(document).on('click', '.delete-user', function () {
        const userId = $(this).data('id');
        if (confirm('Вы уверены, что хотите удалить пользователя?')) {
            $.ajax({
                url: '/user/delete/',
                method: 'POST',
                data: { id: userId },
                success: function () {
                    alert('Пользователь удален');
                    location.reload();
                },
                error: function () {
                    alert('Ошибка удаления пользователя');
                }
            });
        }
    });
</script>
