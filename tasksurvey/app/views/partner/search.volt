
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("partner/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("partner/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Partner</th>
            <th>Name</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for partner in page.items %}
        <tr>
            <td>{{ partner.partner_id }}</td>
            <td>{{ partner.name }}</td>
            <td>{{ link_to("partner/edit/"~partner.partner_id, "Edit") }}</td>
            <td>{{ link_to("partner/delete/"~partner.partner_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("partner/search", "First") }}</td>
                        <td>{{ link_to("partner/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("partner/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("partner/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
