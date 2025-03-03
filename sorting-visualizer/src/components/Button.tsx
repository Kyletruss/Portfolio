interface Props {
  title: string;
  onClick: () => void;
  color?: "primary" | "secondary" | "danger" | "success" | "warning";
}

const Button = ({ title, onClick, color = "primary" }: Props) => {
  return (
    <button className={"btn btn-" + color} onClick={onClick}>
      {title}
    </button>
  );
};

export default Button;
