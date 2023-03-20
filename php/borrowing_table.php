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
        <?php

include 'Collection.php';
$cards = Borrowings::getBorrowings();
foreach ($cards as $card) {
  if($card->getStatus()  ==='Checked out' ){

 
  $initials = strtoupper(substr($card->getFirstname(), 0, 1) . substr($card->getLastname(), 0, 1));
?>
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <div class="rounded-circle  d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;background-color: #ff8049;">
                  <span class="text-white display-6 font-weight-bold"><?php 
                  echo $initials; ?></span>
                </div>
                <div class="ms-3">
                  <p class="fw-bold mb-1"><?php echo $card->getFirstname().' '.$card->getLastname() ; ?></p>
                  <p class="text-muted mb-0"><?php echo $card->getEmail(); ?></p>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <img src="<?php echo $card->getCoverImage(); ?>"  alt="" style="width: 55px; height: 85px; border-radius: 10px;" class=""/>
                <div class="ms-3">
                  <p class="fw-normal mb-1"><?php echo $card->getTitle(); ?></p>
                  <p class="text-muted mb-0"><?php echo $card->getAuthorName(); ?></p>
                </div>
              </div>

            </td>
            <td>
              <p><?php echo $card->getBorrowingDate(); ?></p>
            </td>
            <td>
              <p><?php echo $card->getBorrowingReturnDate(); ?></p>
            </td>
            <td>
              <button type="button"  data-bs-toggle='modal' data-bs-backdrop="false" data-bs-target="#borrow<?php echo $card->getCollectionCode(); ?>" role="button" class="btn  btnborrowing">
                returned
              </button>
               <!-- Modal borrow -->
      <div class="modal " id="borrow<?php echo $card->getCollectionCode(); ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content h-25">
            <div class="modal-body texte-white bgmodal">
              <h3>Can you please confirm if the book has been returned ?</h3>
              <form  action="return.php" method="POST" id="reserveform" enctype="multipart/form-data">
                <input type="hidden" name="collection_code" value="<?php echo $card->getCollectionCode(); ?>" id="collection_id">
                <input type="hidden" name="Reservation_Code" value="<?php echo $card->getReservationCode(); ?>" id="reserve_id">
                <input type="hidden" name="Borrowing_Code" value="<?php echo $card->getborrowingCode(); ?>" id="borrow_id">
                <button type="submit" name="borrow">Borrowed</button>
                <button type="button" class="btn btn-secondary buttons" data-bs-dismiss="modal">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
            </td>
          </tr>
          <?php  }}?>
        </tbody>
      </table>