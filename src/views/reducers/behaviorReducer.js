const initialState = {
  behavior: "enter"
};

const behaviorReducer = (state = initialState, action) => {
  if (action.type === "REQUIRE_MKDIR_FORM") {
    return {
      ...state,
      behavior: action.payload.behavior
    };
  } else if (action.type === "BREAK_MKDIR_FORM") {
    return {
      ...state,
      behavior: action.payload.behavior
    };
  } else if (action.type === "GET_RESOURCES") {
    return {
      ...state,
      behavior: action.payload.behavior
    };
  } else if (action.type === "CLICK_SIGNIN_OR_UP") {
    return {
      ...state,
      behavior: action.payload.behavior
    };
  } else if (action.type === "REQUIRE_VERIFY_FORM") {
    return {
      ...state,
      behavior: action.payload.behavior
    };
  } else if (action.type === "REQUIRE_SIGNIN_OR_UP_FORM") {
    return {
      ...state,
      behavior: action.payload.behavior
    };
  } else {
    return {
      ...state
    };
  }
};

export default behaviorReducer;