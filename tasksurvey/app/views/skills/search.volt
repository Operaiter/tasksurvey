
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("skills/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("skills/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Skills</th>
            <th>Partner</th>
            <th>Name</th>
            <th>Name Of Short</th>
            <th>Description</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for skill in page.items %}
        <tr>
            <td>{{ skill.skills_id }}</td>
            <td>{{ skill.partner_id }}</td>
            <td>{{ skill.name }}</td>
            <td>{{ skill.name_short }}</td>
            <td>{{ skill.description }}</td>
            <td>{{ link_to("skills/edit/"~skill.skills_id, "Edit") }}</td>
            <td>{{ link_to("skills/delete/"~skill.skills_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("skills/search", "First") }}</td>
                        <td>{{ link_to("skills/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("skills/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("skills/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
