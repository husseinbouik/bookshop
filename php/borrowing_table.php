    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
          <tr>
            <th>Username</th>
            <th>book</th>
            <th>borrowing date</th>
            <th>Return date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr >
          <div>
            <td>
              <div class="d-flex align-items-center">
                <div class="rounded-circle  d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;background-color: #ff8049;">
                  <span class="text-white display-1 font-weight-bold"><?php 
                  // echo $initials;
                   ?></span>
                </div>
                <div class="ms-3">
                  <p class="fw-bold mb-1">John Doe</p>
                  <p class="text-muted mb-0">john.doe@gmail.com</p>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <img src="../imgs/Group 48.png"  alt="" style="width: 55px; height: 85px; border-radius: 10px;" class=""/>
                <div class="ms-3">
                  <p class="fw-normal mb-1">Call me by your name </p>
                  <p class="text-muted mb-0">Lucas Roderiger</p>
                </div>
              </div>

            </td>
            <td>
              <p>11/05/2002 10:35</p>
            </td>
            <td>
                <p>21/05/2002 10:35</p>
              </td>
            <td>
              <button type="button" class="btn btnborrowing">
                Borrowed
              </button>
            </td>
        </div>
          </tr>
        </tbody>
      </table>