
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("skills_user/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("skills_user/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>User</th>
            <th>Skills</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for skills_user in page.items %}
        <tr>
            <td>{{ skills_user.user_id }}</td>
            <td>{{ skills_user.skills_id }}</td>
            <td>{{ link_to("skills_user/edit/"~skills_user.user_id, "Edit") }}</td>
            <td>{{ link_to("skills_user/delete/"~skills_user.user_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("skills_user/search", "First") }}</td>
                        <td>{{ link_to("skills_user/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("skills_user/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("skills_user/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
