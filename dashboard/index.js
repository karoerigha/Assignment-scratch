function showDepartments() {
    const facultyDropdown = document.getElementById("facultyDropdown");
    const departmentContainer = document.getElementById(
      "departmentContainer"
    );
    const departments = {
      LAW: ["LAW101", "LAW102"],
      LSC: ["LSC201", "LSC202"],
      MED: ["MED301", "MED302"],
      MGS: ["MGS401", "MGS402"],
      PSC: ["PSC501", "PSC502"],
      SSC: ["SSC601", "SSC602"],
    };

    if (facultyDropdown.value !== "") {
      departmentContainer.classList.remove("hidden");
      const departmentTableBody = document.querySelector(
        "#departmentContainer tbody"
      );
      departmentTableBody.innerHTML = "";

      for (const departmentCode of departments[facultyDropdown.value]) {
        const row = document.createElement("tr");
        row.innerHTML = `
        <td>${departmentCode}</td>
        <td>${getDepartmentName(departmentCode)}</td>
      `;
        departmentTableBody.appendChild(row);
      }
    } else {
      departmentContainer.classList.add("hidden");
    }
  }

  function getDepartmentName(departmentCode) {
    // You can implement a logic to get the department name based on the code
    return "Department " + departmentCode.slice(-2);
  }

  function redirectToProfile() {
    const studentIdInput = document.getElementById("studentIdInput");
    const studentId = studentIdInput.value.trim();
    if (studentId !== "") {
      // Redirect to the user profile page with the student ID
      window.location.href = `user_profile.php?studentId=${studentId}`;
    }
  }