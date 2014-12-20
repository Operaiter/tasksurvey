
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("mission_user_state/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("mission_user_state/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>State</th>
            <th>Mission</th>
            <th>User</th>
            <th>State</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for mission_user_state in page.items %}
        <tr>
            <td>{{ mission_user_state.state_id }}</td>
            <td>{{ mission_user_state.mission_id }}</td>
            <td>{{ mission_user_state.user_id }}</td>
            <td>{{ mission_user_state.state }}</td>
            <td>{{ link_to("mission_user_state/edit/"~mission_user_state.state_id, "Edit") }}</td>
            <td>{{ link_to("mission_user_state/delete/"~mission_user_state.state_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("mission_user_state/search", "First") }}</td>
                        <td>{{ link_to("mission_user_state/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("mission_user_state/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("mission_user_state/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
