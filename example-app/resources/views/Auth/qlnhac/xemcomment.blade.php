@include('layoutsAdmin.top')
<div class="">

</div>
@if (Auth::guard('api')->check())
    <div>
        <div class="comment">
            <div class="DivCommentWrapper" style="height: 156px">
                <div class="DivCommentHeader">
                    <div class="DivCommentTotal">
                        <div class="BNhLuN">{{ $countComment }} Bình luận</div>
                    </div>
                    <div class="DivDropdown">
                        <div class="SortButtonWithThreeLinesSvg">
                            <div class="SortButtonWithThreeLinesSvgFill">
                                <div class="SortButtonWithThreeLinesSvg"
                                    style="width: 18px; height: 18px; position: relative">
                                    <div class="Vector"
                                        style="width: 18px; height: 12px; left: 0px; top: 3px; position: absolute; ">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="DivNewComment"
                    style="height: 86.33px; flex-direction: column; justify-content: flex-start; align-items: flex-end; gap: 7px; display: inline-flex">
                    <div class="DivNewCommentInput"
                        style="display: flex;justify-content: center;align-items: center;width: 400px; height: 46.33px; position: relative; background: white; border-radius: 5px; border: 1px #DCDCDC solid">
                        <input class="NhPBNhLuNCABN" placeholder="Nhập bình luận của bạn..."
                            style="width: 94%;align-self: stretch; color: #757575; font-size: 14px; font-family: Arial; font-weight: 400; word-wrap: break-word; outline: none; border: none ;padding: 10px">
                        </input>
                    </div>
                    <div class="DivCommentButton"
                        style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 4.46px; display: inline-flex">
                        <div class="DivCmBtn"
                            style="cursor: pointer;padding-left: 20px; padding-right: 20px; padding-top: 6px; padding-bottom: 6px; background: #F6F6F6; border-radius: 5px; justify-content: flex-start; align-items: flex-start; display: flex">
                            <div class="HYB"
                                style="text-align: center; color: #969696; font-size: 14px; font-family: Arial; font-weight: 400; line-height: 21px; word-wrap: break-word">
                                Hủy bỏ</div>
                        </div>
                        <div class="DivSubmitCommentBtn" data-songcomment="{{ $Nhacalbumbaihat }}"
                            style="cursor: pointer;padding-left: 20px; padding-right: 20px; padding-top: 6px; padding-bottom: 6px; background: #1A86F1; border-radius: 5px; justify-content: flex-start; align-items: flex-start; display: flex">
                            <div class="BNhLuaN"
                                style="text-align: center; color: white; font-size: 14px; font-family: Arial; font-weight: 400; line-height: 21px; word-wrap: break-word">
                                Bình luận</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="commetus">
                @foreach ($comment as $item)
                    <div class="itemcomment">
                        <div class="itemcomment-img"><img src="../../images/{{ $item->hinh }}" alt="">
                        </div>
                        <div class="itemcomment-info">
                            <div class="itemcomment-ten">{{ $item->ten }} <span>{{ $item->time }}</span>
                                <span style="cursor: pointer;" class="delete_comment"
                                    data-comment="{{ $item->id }}"><i class="bi bi-trash"></i>
                                    Xóa</span>
                            </div>
                            <p class="itemcomment-comment">{{ $item->noidung }} </p>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
@endif
@include('layoutsAdmin.bottom')
