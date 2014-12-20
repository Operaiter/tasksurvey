
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("state_user/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("state_user/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>User</th>
            <th>State</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for state_user in page.items %}
        <tr>
            <td>{{ state_user.user_id }}</td>
            <td>{{ state_user.state_id }}</td>
            <td>{{ link_to("state_user/edit/"~state_user.user_id, "Edit") }}</td>
            <td>{{ link_to("state_user/delete/"~state_user.user_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("state_user/search", "First") }}</td>
                        <td>{{ link_to("state_user/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("state_user/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("state_user/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
