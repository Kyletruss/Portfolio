// import { MouseEvent } from "react";
import { useState } from "react";

interface Props {
    items: string[];
    heading: string;
    onSelectItem: (item: string) => void;
} 


function ListGroup({items, heading, onSelectItem}: Props) {


// arr[0] variable
// arr[1] update function
  const [selectedIndex, setSelectedIndex] = useState(-1)


//   const handleClick = (event: MouseEvent) => console.log(event)

  return (
    <>
      <h1>{heading}</h1>
      {/* basically if true, return the element, if false return false */}
      {items.length === 0 && <p>No item found</p>}
      <ul className="list-group">
        {items.map((item, index) => (
          <li
            className={selectedIndex === index ? "list-group-item active" : "list-group-item"}
            key={item}
            onClick={() => {
                setSelectedIndex(index);
                onSelectItem(item);
            }}
          >
            {item}
          </li>
        ))}
      </ul>
    </>
  );
}

export default ListGroup;
